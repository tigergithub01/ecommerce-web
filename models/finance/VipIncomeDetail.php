<?php

namespace app\models\finance;

use Yii;
use app\models\vip\Vip;
use app\models\product\Product;
use app\models\order\SoSheet;

/**
 * This is the model class for table "t_vip_income_detail".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $vip_id
 * @property integer $sub_vip_id
 * @property string $amount
 * @property string $deduct_price
 */
class VipIncomeDetail extends \yii\db\ActiveRecord {

    // Transient fields
    public $sub_vip_no;
    public $order_code;
    public $product_name;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 't_vip_income_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [
                [
                    'order_id',
                    'product_id',
                    'vip_id',
                    'sub_vip_id'
                ],
                'required'
            ],
            [
                [
                    'order_id',
                    'product_id',
                    'vip_id',
                    'sub_vip_id'
                ],
                'integer'
            ],
            [
                [
                    'amount',
                    'deduct_price'
                ],
                'number'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => '主键编号',
            'order_id' => '订单编号',
            'product_id' => '关联产品编号',
            'vip_id' => '会员编号',
            'sub_vip_id' => '贡献分润会员编号',
            'amount' => '贡献分润金额',
            'deduct_price' => '产品分润单价'
        ];
    }

    public function getVip() {
        return $this->hasOne(Vip::className(), ['id' => 'vip_id']);
    }

    public function getSubVip() {
        return $this->hasOne(Vip::className(), ['id' => 'sub_vip_id'])->from(Vip::tableName()." subVip");
    }

    public function getOrder() {
        return $this->hasOne(SoSheet::className(), ['id' => 'order_id']);
    }

    public function getProduct() {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

}
