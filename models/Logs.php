<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Logs".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $ip
 * @property string $level
 * @property string $action
 * @property string $description
 * @property string $created_at
 *
 * @property Users $user
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ip', 'level', 'action', 'description'], 'required'],
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['ip'], 'string', 'max' => 64],
            [['level'], 'string', 'max' => 15],
            [['action'], 'string', 'max' => 63],
            [['description'], 'string', 'max' => 255],
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
            'ip' => 'Ip',
            'level' => 'Level',
            'action' => 'Action',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
