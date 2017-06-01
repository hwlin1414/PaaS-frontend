<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Groups".
 *
 * @property integer $id
 * @property string $name
 *
 * @property GroupPerms[] $groupPerms
 * @property Users[] $users
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32],
            [['name'], 'unique'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupPerms()
    {
        return $this->hasMany(GroupPerms::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['group_id' => 'id']);
    }
    public function hasPermission($controller, $action)
    {
        $data = intval(GroupPerms::find()
            ->where(['group_id' => $this->id, 'permission' => $controller.'/'.$action])
            ->orWhere(['group_id' => $this->id, 'permission' => $controller.'/*'])
            ->orWhere(['group_id' => $this->id, 'permission' => $controller])
            ->orWhere(['group_id' => $this->id, 'permission' => '*'])
            ->count());
        return $data !== 0;
    }
}
