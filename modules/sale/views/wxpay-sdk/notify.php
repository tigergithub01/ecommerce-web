<?php
use app\modules\api\service\VipOrderService;

ini_set('date.timezone','Asia/Shanghai');
error_reporting(E_ERROR);

require_once "lib/WxPay.Api.php";
require_once 'lib/WxPay.Notify.php';
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler(__DIR__."/logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

/**
<xml><appid><![CDATA[wx10d9f809def66ba3]]></appid>
<bank_type><![CDATA[CMB_DEBIT]]></bank_type>
<cash_fee><![CDATA[1]]></cash_fee>
<fee_type><![CDATA[CNY]]></fee_type>
<is_subscribe><![CDATA[Y]]></is_subscribe>
<mch_id><![CDATA[1233515602]]></mch_id>
<nonce_str><![CDATA[bkz745am61xqqxi6x8o9dd9soub46nby]]></nonce_str>
<openid><![CDATA[oEApts51Xp2IKJ423-hytjWif8ms]]></openid>
<out_trade_no><![CDATA[SO-20150801-00065]]></out_trade_no>
<result_code><![CDATA[SUCCESS]]></result_code>
<return_code><![CDATA[SUCCESS]]></return_code>
<sign><![CDATA[527FD66BFF0C2106AB8F0916D7843F50]]></sign>
<time_end><![CDATA[20150801173813]]></time_end>
<total_fee>1</total_fee>
<trade_type><![CDATA[JSAPI]]></trade_type>
<transaction_id><![CDATA[1007850065201508010523504215]]></transaction_id>
</xml>
 * @author Tiger-guo
 *
 */
class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}		
		
		//TODO:business code
		$trade_status = 'TRADE_SUCCESS';
		$order_no = $data["out_trade_no"];
		$trade_no = $data["transaction_id"];
		$total_fee = $data["total_fee"];
		
		
		$service = new VipOrderService();
		$service->executeOrderPayWx($order_no, $trade_no, $trade_status,round($total_fee/100,2));
		
		return true;
	}
}

Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);
