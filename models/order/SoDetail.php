<?php

namespace app\models\order;

use Yii;
use app\models\product\Product;
/**
 * This is the model class for table "t_so_detail".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $quantity
 * @property string $price
 * @property string $amount
 */
class SoDetail extends \yii\db\ActiveRecord
{
    
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_so_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id'], 'required'],
            [['order_id', 'product_id'], 'integer'],
            [['quantity', 'price', 'amount'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'order_id' => '关联订单编号',
            'product_id' => '关联产品编号',
            'quantity' => '购买数量',
            'price' => '单价',
            'amount' => '金额',
        ];
    }
    
     public function getProduct(){
         return $this->hasOne(Product::className(), ['id'=>'product_id']);
     }
}
