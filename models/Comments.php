<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Comments".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $comment
 * @property integer $creator
 * @property string $created_at
 *
 * @property Users $creator0
 * @property Users $user
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'comment', 'creator'], 'required'],
            [['user_id', 'creator'], 'integer'],
            [['created_at'], 'safe'],
            [['comment'], 'string', 'max' => 1024],
            [['creator'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['creator' => 'id']],
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
            'comment' => 'Comment',
            'creator' => 'Creator',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator0()
    {
        return $this->hasOne(Users::className(), ['id' => 'creator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
