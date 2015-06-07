<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_vip_module".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 */
class VipModule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_vip_module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 60],
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
            'name' => '模块名称',
        ];
    }
}
