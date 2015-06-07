<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_app_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $release_id
 */
class AppInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_app_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['release_id'], 'integer'],
            [['name'], 'string', 'max' => 60],
            [['description'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'name' => '版本名称(1.1.1，字符串型)',
            'description' => '产品描述',
            'release_id' => '关联最新发布编号',
        ];
    }
}
