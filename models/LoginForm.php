<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\ServerErrorHttpException;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $radius = radius_auth_open();
            $radius_config = Yii::$app->params['radius'];
            radius_add_server(
                $radius,
                $radius_config['hostname'],
                $radius_config['port'],
                $radius_config['secret'],
                $radius_config['timeout'],
                3
            );
            radius_create_request($radius, RADIUS_ACCESS_REQUEST);
            radius_put_attr($radius, RADIUS_USER_NAME, $this->username);
            radius_put_attr($radius, RADIUS_USER_PASSWORD, $this->password);
            $result = radius_send_request($radius);
            
            switch ($result) {
            case RADIUS_ACCESS_ACCEPT:
                $user = Users::findOne(['name' => $this->username]);
                if(!$user){
                    $user = new Users();
                    $user->name = $this->username;
                    $user->amount = (Configs::findOne('defaultUserAmount'))?(Configs::findOne('defaultUserAmount')->value()):'1';
                    $user->group_id = (Configs::findOne('defaultUserGroup'))?(Configs::findOne('defaultUserGroup')->value()):'1';
                    $user->enabled = (Configs::findOne('defaultUserEnabled'))?(Configs::findOne('defaultUserEnabled')->value()):'1';
                    $user->authkey = Yii::$app->getSecurity()->generateRandomString(12);
                    $user->created_at = date('Y-m-d H:i:s');
                    $user->validate();
                    $user->save();
                }
                if($user->enabled == 0){
                    $this->addError($attribute, '帳號或密碼錯誤');
                }
                return;
            case RADIUS_ACCESS_REJECT:
                $this->addError($attribute, '帳號或密碼錯誤');
                break;
            case RADIUS_ACCESS_CHALLENGE:
                ServerErrorHttpException('Radius server ask for challenge');
                break;
            default:
                ServerErrorHttpException('Radius: '.radius_strerror($radius));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::findByUsername($this->username);
        }
        return $this->_user;
    }

    public function AttributeLabels()
    {
        return [
            'username' => '帳號',
            'password' => '密碼',
            'rememberMe' => '記住我',
        ];
    }
}
