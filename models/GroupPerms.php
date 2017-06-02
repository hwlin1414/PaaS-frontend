<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "GroupPerms".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $permission
 *
 * @property Groups $group
 */
class GroupPerms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'GroupPerms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'permission'], 'required'],
            [['group_id'], 'integer'],
            [['permission'], 'string', 'max' => 64],
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
            'group_id' => '群組',
            'permission' => '權限',
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['permission'],
            'search' => ['permission'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'group_id']);
    }
}
