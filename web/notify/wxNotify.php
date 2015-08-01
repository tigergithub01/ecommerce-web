<?php

$data = $GLOBALS['HTTP_RAW_POST_DATA'];
//var_dump($data);

//$file_in = file_get_contents("php://input"); //接收post数据

//$xml = simplexml_load_string($file_in);//转换post数据为simplexml对象


$notify_url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?r=/sale/wxpay/notify';
// create a new curl resource
$ch = curl_init();
// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL,$notify_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// grab URL, and print
curl_exec($ch);
curl_close($ch);

exit();