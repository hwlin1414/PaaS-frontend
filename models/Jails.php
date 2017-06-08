<?php

namespace app\models;

use Yii;
use yii\httpclient\Client;

/**
 * This is the model class for table "Jails".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $hostname
 * @property string $ip
 * @property string $quota
 * @property integer $enabled
 * @property integer $enabledby
 * @property string $description
 * @property string $sshkey
 * @property string $created_at
 * @property string $enabled_at
 * @property string $expired_at
 *
 * @property Users $enabledby0
 * @property Users $user
 */
class Jails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Jails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'hostname', 'ip', 'quota', 'description', 'sshkey'], 'required'],
            [['user_id', 'enabled', 'enabledby'], 'integer'],
            [['created_at', 'enabled_at', 'expired_at'], 'safe'],
            [['hostname', 'quota'], 'string', 'max' => 16],
            [['ip'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 255],
            [['sshkey'], 'string', 'max' => 1024],
            [['enabledby'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['enabledby' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '帳號',
            'hostname' => '主機名稱',
            'ip' => 'IP',
            'quota' => '配額',
            'enabled' => '啟用',
            'enabledby' => '啟用人',
            'description' => '描述',
            'sshkey' => 'SSH-Key',
            'created_at' => '建立日期',
            'enabled_at' => '啟用日期',
            'expired_at' => '到期日期',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnabledby0()
    {
        return $this->hasOne(Users::className(), ['id' => 'enabledby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /* APIs */
    public static function getList()
    {
        $model = IpPool::findOne(['ip' => $this->ip]);
        if($model == null) return null;

        $api = Yii::$app->param['api'][$model->host];
        $client = new Client(['baseUrl' => $api]);
        $client->setOptions(['timeout' => 3]);
        $response = $client->get('list.php');
        return $response->data;
    }
    public function getStatus()
    {
        $data = static::$list;
        if($data == null) return null;
        foreach($data as $d){
            if($d->name == $this->hostname){
                return $d;
            }
        }
    }
    public function getRuntime()
    {
        $model = IpPool::findOne(['ip' => $this->ip]);
        if($model == null) return null;

        $api = Yii::$app->param['api'][$model->host];
        $client = new Client(['baseUrl' => $api]);
        $client->setOptions(['timeout' => 3]);
        $response = $client->post('runtime.php', ['name' => $this->hostname]);
        return $response->data;
    }
    public function deploy(){
        $model = IpPool::findOne(['ip' => $this->ip]);
        if($model == null) return null;

        $api = Yii::$app->param['api'][$model->host];
        $client = new Client(['baseUrl' => $api]);
        $client->setOptions(['timeout' => 20]);
        $response = $client->post('create.php', [
            'name' => $this->hostname,
            'ip' => $this->ip,
            'size' => $this->size,
            'key' => $this->sshkey,
        ]);
    }
    public function revoke(){
        $model = IpPool::findOne(['ip' => $this->ip]);
        if($model == null) return null;

        $api = Yii::$app->param['api'][$model->host];
        $client = new Client(['baseUrl' => $api]);
        $client->setOptions(['timeout' => 20]);
        $response = $client->post('delete.php', ['name' => $this->hostname]);

    }
    public function control($action){
        $model = IpPool::findOne(['ip' => $this->ip]);
        if($model == null) return null;

        $api = Yii::$app->param['api'][$model->host];
        $client = new Client(['baseUrl' => $api]);
        $client->setOptions(['timeout' => 20]);
        $response = $client->post('control.php', [
            'name' => $this->hostname,
            'action' => $action,
        ]);

    }
}
