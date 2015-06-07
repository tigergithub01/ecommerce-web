<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_sys_config".
 *
 * @property integer $id
 * @property string $code
 * @property string $value
 * @property string $description
 */
class SysConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_sys_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'value'], 'required'],
            [['code'], 'string', 'max' => 30],
            [['value'], 'string', 'max' => 60],
            [['description'], 'string', 'max' => 200],
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
            'code' => '唯一编码',
            'value' => '值',
            'description' => '描述',
        ];
    }
}
