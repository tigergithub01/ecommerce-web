<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_usage_rights".
 *
 * @property integer $id
 * @property string $content
 */
class UsageRights extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_usage_rights';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'content' => '内容',
        ];
    }
}
