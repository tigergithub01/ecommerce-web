<?php

namespace app\models\order;

use Yii;

/**
 * This is the model class for table "t_so_sheet_draft".
 *
 * @property integer $id
 * @property integer $vip_id
 * @property string $order_amt
 * @property string $order_quantity
 * @property string $deliver_fee
 * @property string $order_date
 * @property integer $delivery_type
 * @property string $pay_amt
 * @property string $message
 * @property integer $invoice_type
 * @property string $invoice_header
 * @property integer $address_id
 */
class SoSheetDraft extends \yii\db\ActiveRecord
{
    
	//transient fields
	public $soDetailList;
	public $vip;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_so_sheet_draft';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_id', 'delivery_type', 'invoice_type', 'address_id'], 'integer'],
            [['order_amt', 'order_quantity', 'deliver_fee', 'pay_amt'], 'number'],
            [['order_date'], 'required'],
            [['order_date'], 'safe'],
            [['message'], 'string', 'max' => 300],
            [['invoice_header'], 'string', 'max' => 100]
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
            'order_amt' => '订单金额',
            'order_quantity' => '产品数量',
            'deliver_fee' => '运费',
            'order_date' => '订单提交日期',
            'delivery_type' => '配送方式',
            'pay_amt' => '付款金额',
            'message' => '买家留言',
            'invoice_type' => '发票类型',
            'invoice_header' => '发票抬头',
            'address_id' => '关联收货地址编号',
        ];
    }
    
    function setVip($vip){
    	$this->vip = $vip;
    }
}
