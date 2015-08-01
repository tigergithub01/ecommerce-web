<?php
// Do a POST
$data="<xml><appid><![CDATA[wx10d9f809def66ba3]]></appid>
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
</xml>";

//$data = array('name' => 'Dennis', 'surname' => 'Pallett');

$cul_url = 'http://'.$_SERVER['HTTP_HOST'].'/notify/alipay/wap/alipayNotify.php';

// create a new curl resource
$ch = curl_init();
// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL,$cul_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// grab URL, and print
curl_exec($ch);
curl_close($ch);

exit();