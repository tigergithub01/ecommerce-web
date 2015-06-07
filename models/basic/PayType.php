<?php

namespace app\models\basic;

use Yii;

/**
 * This is the model class for table "t_pay_type".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $rate
 * @property string $description
 * @property integer $status
 */
class PayType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_pay_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'status'], 'required'],
            [['rate'], 'number'],
            [['status'], 'integer'],
            [['code'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 60],
            [['description'], 'string', 'max' => 400],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => '支付方式唯一编码',
            'name' => '支付方式名称',
            'rate' => '费率',
            'description' => '描述',
            'status' => '状态（1:有效、0:停用）',
        ];
    }
}
