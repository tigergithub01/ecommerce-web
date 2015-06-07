<?php

namespace app\models\order;

use Yii;

/**
 * This is the model class for table "t_out_stock_detail".
 *
 * @property integer $id
 * @property integer $out_id
 * @property integer $product_id
 * @property string $order_quantity
 * @property string $out_quantity
 */
class OutStockDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_out_stock_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['out_id', 'product_id'], 'required'],
            [['out_id', 'product_id'], 'integer'],
            [['order_quantity', 'out_quantity'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'out_id' => '关联发货单编号',
            'product_id' => '关联产品编号',
            'order_quantity' => '订单数量',
            'out_quantity' => '本次发货数量',
        ];
    }
}
