<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "IpPools".
 *
 * @property integer $id
 * @property string $ip
 * @property string $host
 */
class IpPools extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'IpPools';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip', 'host'], 'required'],
            [['ip', 'host'], 'string', 'max' => 64],
            [['ip'], 'ip', 'ipv6' => false],
            [['ip'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'IP',
            'host' => '主機名稱',
        ];
    }
}
