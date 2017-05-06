<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Configs".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 */
class Configs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Configs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['key'], 'string', 'max' => 64],
            [['value'], 'string', 'max' => 256],
            [['key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }
}
