<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Users".
 *
 * @property integer $id
 * @property string $name
 * @property integer $amount
 * @property integer $group_id
 * @property integer $enabled
 * @property string $authkey
 * @property string $created_at
 *
 * @property Comments[] $comments
 * @property Comments[] $comments0
 * @property Jails[] $jails
 * @property Jails[] $jails0
 * @property Logs[] $logs
 * @property Groups $group
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'amount', 'group_id', 'enabled', 'authkey'], 'required'],
            [['amount', 'group_id', 'enabled'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 32],
            [['authkey'], 'string', 'max' => 16],
            [['name'], 'unique'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'amount' => 'Amount',
            'group_id' => 'Group ID',
            'enabled' => 'Enabled',
            'authkey' => 'Authkey',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['creator' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments0()
    {
        return $this->hasMany(Comments::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJails()
    {
        return $this->hasMany(Jails::className(), ['enabledby' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJails0()
    {
        return $this->hasMany(Jails::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Logs::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['name' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authkey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authkey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return $this->password === $password;
        return false;
    }
    public function hasPermission($controller, $action)
    {
        return $this->group->hasPermission($controller, $action);
    }
}
