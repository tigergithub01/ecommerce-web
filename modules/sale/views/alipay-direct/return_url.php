<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */
use app\modules\api\service\VipOrderService;

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");

?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
//http://app.mantanghao.com/index.php?r=/sale/alipay-direct/return&buyer_email=13724346621&buyer_id=2088202312703969&exterface=create_direct_pay_by_user&is_success=T&notify_id=RqPnCoPT3K9%252Fvwbh3InVbh9YF3f8Y%252F3uVJUZdnhjpMD8M3q6l2eS3F6xu4El4OHL11K6&notify_time=2015-08-21+18%3A42%3A38&notify_type=trade_status_sync&out_trade_no=SO-20150821-00101&payment_type=1&seller_email=wiriclub%40163.com&seller_id=2088911913702384&subject=%E3%80%90%E9%AD%85%E5%85%B8%E5%B9%BB%E9%95%9C%E3%80%91%E5%8E%9F%E5%88%9B%E8%87%AA%E5%88%B6%E8%B5%AB%E6%9C%AC%E6%B0%94%E8%B4%A8%E5%AE%AB%E5%BB%B7%E8%8C%83%E7%BB%A3%E8%8A%B1%E8%95%BE%E4%B8%9D%E7%AB%8B%E9%A2%86%E7%B2%BE%E5%93%81%E8%A1%AC%E8%A1%AB%E4%B8%8A%E8%A1%A3&total_fee=0.01&trade_no=2015082100001000960058321544&trade_status=TRADE_SUCCESS&sign=0261cde3521bd6effa1d669aac118292&sign_type=MD5
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号
	$out_trade_no = $_GET['out_trade_no'];

	//支付宝交易号
	$trade_no = $_GET['trade_no'];

	//交易状态
	$trade_status = $_GET['trade_status'];


    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//如果有做过处理，不执行商户的业务程序
    	$total_fee = $_GET['total_fee'];
    	
		$service = new VipOrderService();	
		$service->executeOrderPayAlipay($out_trade_no, $trade_no, $trade_status,$total_fee);
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
		
	//echo "验证成功<br />";

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	//跳转到订单处理页面
	$return_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?r=/sale/vip-order/view&code='.$out_trade_no;
	Header("Location: $return_url");
	exit();
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
        <title>支付宝即时到账交易接口</title>
	</head>
    <body>
    </body>
</html>