<?php

namespace app\models\order;

use Yii;

/**
 * This is the model class for table "t_shopping_cart".
 *
 * @property integer $id
 * @property integer $vip_id
 * @property integer $product_id
 * @property string $quantity
 * @property string $price
 * @property string $amount
 * @property string $create_date
 * @property string $update_date
 */
class ShoppingCart extends \yii\db\ActiveRecord
{
    
	//transient fields
    public $product;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_shopping_cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_id', 'product_id', 'quantity', 'create_date'], 'required'],
            [['vip_id', 'product_id'], 'integer'],
            [['quantity', 'price', 'amount'], 'number'],
            [['create_date', 'update_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'vip_id' => '会员编号',
            'product_id' => '关联产品编号',
            'quantity' => '购买数量',
            'price' => '单价',
            'amount' => '金额',
            'create_date' => '创建日期',
            'update_date' => '修改日期',
        ];
    }
    
    public function setProduct($product){
    	$this->product = $product;
    }
}
