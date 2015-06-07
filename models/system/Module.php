<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_module".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $parent_id
 * @property string $url
 */
class Module extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['parent_id'], 'integer'],
            [['code'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 60],
            [['url'], 'string', 'max' => 200],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'code' => '模块唯一编码',
            'name' => '模块名称',
            'parent_id' => '关联上级模块主键编号',
            'url' => '模块URL地址',
        ];
    }
}
