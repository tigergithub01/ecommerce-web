<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_user_guild".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 */
class UserGuild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user_guild';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'title' => '标题',
            'content' => '内容',
        ];
    }
}
