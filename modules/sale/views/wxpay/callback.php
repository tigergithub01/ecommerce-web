<?php 


ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

//初始化日志

$logHandler= new CLogFileHandler(__DIR__."/logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";        
    }
}

//①、获取用户openid
$openId = $model['open_id'];

$tools = new JsApiPay();
/*
$openId = $tools->GetOpenid();
$log::INFO('wxjsapi openId:'+(isset($openId)?$openId:''));
*/




//②、统一下单

//商户订单号
// $out_trade_no = $_POST['WIDout_trade_no'];
// $out_trade_no = isset($_POST['WIDout_trade_no'])?$_POST['WIDout_trade_no']:null;
$out_trade_no = $model['WIDout_trade_no'];
//商户网站订单系统中唯一订单号，必填

//订单名称
// $subject = $_POST['WIDsubject'];
$subject = $model['WIDsubject'];
// $subject = isset($_POST['WIDsubject'])?$_POST['WIDsubject']:null;
//必填

//付款金额
// $total_fee = $_POST['WIDtotal_fee'];
$total_fee = $model['WIDtotal_fee'];
// $total_fee = isset($_POST['WIDtotal_fee'])?$_POST['WIDtotal_fee']:null;

//notify url
$notify_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?r=/sale/wxpay/notify';

// $notify_url = $_SERVER['HTTP_HOST'].URL::toRoute(['/sale/wxpay/notify']);

$input = new WxPayUnifiedOrder();
// $input->SetBody("test");
$input->SetBody($subject);
$input->SetAttach("");
// $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetOut_trade_no($out_trade_no);
// $input->SetTotal_fee("1");
$input->SetTotal_fee($total_fee);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
// $input->SetGoods_tag("test");
$input->SetGoods_tag($subject);
// $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
$input->SetNotify_url($notify_url);
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);
echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
printf_info($order);
$log::INFO('order Info:'.json_encode($order));
$jsApiParameters = $tools->GetJsApiParameters($order);

//获取共享收货地址js函数参数
$editAddress = $tools->GetEditAddressParameters();

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付样例-支付</title>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				alert(res.err_code+res.err_desc+res.err_msg);

				/**
				res.err_msg:
					get_brand_wcpay_request:ok  支付成功
get_brand_wcpay_request:cancel 支付过程中用户取消
get_brand_wcpay_request:fail 支付失败
				*/
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	//获取共享地址
	function editAddress()
	{
		WeixinJSBridge.invoke(
			'editAddress',
			<?php echo $editAddress; ?>,
			function(res){
				var value1 = res.proviceFirstStageName;
				var value2 = res.addressCitySecondStageName;
				var value3 = res.addressCountiesThirdStageName;
				var value4 = res.addressDetailInfo;
				var tel = res.telNumber;
				
				//alert(value1 + value2 + value3 + value4 + ":" + tel);
			}
		);
	}
	
	window.onload = function(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', editAddress, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', editAddress); 
		        document.attachEvent('onWeixinJSBridgeReady', editAddress);
		    }
		}else{
			editAddress();
		}
	};
	
	</script>
</head>
<body>
    <br/>
    <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">￥<?php echo round($model['WIDtotal_fee']/100,2)?></span>元</b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
	</div>
</body>
</html>