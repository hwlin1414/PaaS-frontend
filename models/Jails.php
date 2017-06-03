<?php

namespace app\models;

use Yii;

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
            'user_id' => 'User ID',
            'hostname' => 'Hostname',
            'ip' => 'Ip',
            'quota' => 'Quota',
            'enabled' => 'Enabled',
            'enabledby' => 'Enabledby',
            'description' => 'Description',
            'sshkey' => 'Sshkey',
            'created_at' => 'Created At',
            'enabled_at' => 'Enabled At',
            'expired_at' => 'Expired At',
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
}
