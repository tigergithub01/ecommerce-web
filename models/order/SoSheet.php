<?php

namespace app\models\order;

use Yii;

/**
 * This is the model class for table "t_so_sheet".
 *
 * @property integer $id
 * @property integer $sheet_type_id
 * @property string $code
 * @property integer $vip_id
 * @property string $order_amt
 * @property string $order_quantity
 * @property string $deliver_fee
 * @property integer $status
 * @property integer $settle_flag
 * @property string $order_date
 * @property string $delivery_date
 * @property integer $delivery_type
 * @property string $delivery_no
 * @property integer $pay_type_id
 * @property string $pay_amt
 * @property string $pay_date
 * @property string $return_amt
 * @property string $return_date
 * @property string $memo
 * @property string $message
 */
class SoSheet extends \yii\db\ActiveRecord
{
    
	//transient fields
	public $soDetailList;
	public $vip;
	public $soContactPerson;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_so_sheet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sheet_type_id', 'code', 'vip_id', 'status', 'settle_flag', 'order_date'], 'required'],
            [['sheet_type_id', 'vip_id', 'status', 'settle_flag', 'delivery_type', 'pay_type_id'], 'integer'],
            [['order_amt', 'order_quantity', 'deliver_fee', 'pay_amt', 'return_amt'], 'number'],
            [['order_date', 'delivery_date', 'pay_date', 'return_date'], 'safe'],
            [['code'], 'string', 'max' => 30],
            [['delivery_no'], 'string', 'max' => 60],
            [['memo'], 'string', 'max' => 400],
            [['message'], 'string', 'max' => 300],
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
            'sheet_type_id' => '单据类型',
            'code' => '订单编号(so-年月日-顺序号，根据单据设置进行生成)',
            'vip_id' => '会员编号',
            'order_amt' => '订单金额',
            'order_quantity' => '产品数量',
            'deliver_fee' => '运费',
            'status' => '订单状态（待支付、待发货、待收货、待评价、已完成、已关闭、待退货、待退款）',
            'settle_flag' => '结算状态(1:已结算、0：未结算)',
            'order_date' => '订单提交日期',
            'delivery_date' => '发货日期',
            'delivery_type' => '配送方式',
            'delivery_no' => '快递单号',
            'pay_type_id' => '支付方式（支付宝、微信）',
            'pay_amt' => '付款金额',
            'pay_date' => '付款日期',
            'return_amt' => '退款金额',
            'return_date' => '退款日期',
            'memo' => '备注',
            'message' => '买家留言',
        ];
    }
}
