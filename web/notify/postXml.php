<?php
// Do a POST
$data="<?xml version='1.0' encoding='UTF-8'?>
<TypeRsp>
<CONNECT_ID>1</CONNECT_ID>
<MO_MESSAGE_ID>2</MO_MESSAGE_ID>
</TypeRsp>";

//$data = array('name' => 'Dennis', 'surname' => 'Pallett');

$cul_url = 'http://'.$_SERVER['HTTP_HOST'].'/notify/wxNotify.php';

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