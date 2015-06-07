<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_parameter_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 */
class ParameterType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_parameter_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 60],
            [['description'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'name' => '类型名称',
            'description' => '描述',
        ];
    }
}
