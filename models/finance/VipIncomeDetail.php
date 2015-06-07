<?php

namespace app\models\finance;

use Yii;

/**
 * This is the model class for table "t_vip_income_detail".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $vip_id
 * @property integer $sub_vip_id
 * @property string $amount
 */
class VipIncomeDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_vip_income_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'vip_id', 'sub_vip_id'], 'required'],
            [['order_id', 'product_id', 'vip_id', 'sub_vip_id'], 'integer'],
            [['amount'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'order_id' => '订单编号',
            'product_id' => '关联产品编号',
            'vip_id' => '会员编号',
            'sub_vip_id' => '贡献分润会员编号',
            'amount' => '贡献分润金额',
        ];
    }
}