<?php

namespace app\models\order;

use Yii;
use app\models\vip\Vip;
use app\models\basic\PayType;
use app\models\basic\DeliveryType;

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
 * @property string $trade_no
 * @property string $trade_status
 */
class SoSheet extends \yii\db\ActiveRecord
{
    
	//transient fields
	public $soDetailList;	
	public $soContactPerson;
	public $order_status;
	public $vip_no;
	public $order_status_val;
	public $product_name;
	
	//static 
	//待支付
	public static $so_status_need_pay=3001;
	//待发货
	public static $so_status_need_delivery=3002;
	//待收货
	public static $so_status_need_receive=3003;
	//已完成
	public static $so_status_completed=3005;
	//已关闭
	public static $so_status_closed=3006;
	//待退货
	public static $so_status_need_return=3007;
	//待退款
	public static $so_status_need_refund=3008;
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
            'code' => '订单编号',
            'vip_id' => '会员编号',
            'order_amt' => '订单金额',
            'order_quantity' => '产品数量',
            'deliver_fee' => '运费',
            'status' => '订单状态',
            'settle_flag' => '结算状态',
            'order_date' => '订单提交日期',
            'delivery_date' => '发货日期',
            'delivery_type' => '配送方式',
            'delivery_no' => '快递单号',
            'pay_type_id' => '支付方式',
            'pay_amt' => '付款金额',
            'pay_date' => '付款日期',
            'return_amt' => '退款金额',
            'return_date' => '退款日期',
            'memo' => '备注',
            'message' => '买家留言',
        	'trade_no' => '支付宝交易号',
        	'trade_status' => '支付宝交易状态',
        ];
    }
    
    function getOrderStatus(){
        return $this->hasOne(SoSheetStatus::className(), ['id'=>'status']);      
    }
    
    function getVip(){        
        return $this->hasOne(Vip::className(), ['id'=>'vip_id']);      
    }
    
    function setVip($vip){
    	$this->vip = $vip;
    }
    
    function getSettleFlagText(){
        $settle_flag=[1=>'已结算',0=>'未结算'];
        return key_exists($this->settle_flag, $settle_flag)?$settle_flag[$this->settle_flag]:null;
    }
    
    function getPayType(){
       return $this->hasOne(PayType::className(), ['id'=>'pay_type_id']); 
    }
    
    function getProductItems(){
        return $this->hasMany(SoDetail::className(), ['order_id'=>'id']);
    }
    
    function getDelivery(){
        return $this->hasOne(DeliveryType::className(), ['id'=>'delivery_type']); 
    }
    
    function getContactPerson(){
        return $this->hasMany(SoContactPerson::className(), ['order_id'=>'id']);
    }
    
    function getOutStockSheetList(){
        return $this->hasMany(OutStockSheet::className(), ['order_id'=>'id']);
    }
    
    function getReturnSheetList(){
        return $this->hasMany(ReturnSheet::className(), ['order_id'=>'id']);
    }
}
