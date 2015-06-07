<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '蝶富平台';

?>
<style type="text/css">
body{
	padding: 0px;
	margin: 0px;
}
.container{
	display: block;
	width: 100%;
	margin: 0px;
	height: auto;
	position: relative;
}
.container_bg{
	position: absolute;
	top: 0px;
	left: 0px;
	width: 100%;
	z-index: 1;
}
.btn{
	position: absolute;
	left: 20%;
	width: 60%;
	z-index: 2;
}
.btn img{
	width: 100%;
	border: none;
	margin: 0px;
	z-index: 3;
}
</style>


<div class="container">
		<a style="top: 2685px;" id="btn" class="btn" href="http://ysk.xmgapay.com/wap.php/reg/reg/invite_mobile/13724346621.html"><img src="images/quick_register.png"></a>
		<img class="container_bg" src="images/bg.png">
	</div>

<script type="text/javascript">
window.onload = function(){
	document.getElementById("btn").style.top = parseInt(document.body.scrollHeight - document.getElementById("btn").clientHeight - 6) + "px";
};
</script>


