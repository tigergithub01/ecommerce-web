<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "订单详情";
$this->registerCssFile ('css/sale/header.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/payment.css',['position' => \yii\web\View::POS_HEAD] );

?>


<div class="vip-center-form" style="margin: 10px;">
	<div class="payment_info_bar">
		<div class="item"><span class="tag">收货人</span><span class="content">郭生 13788888888</span></div>
		<hr class="gray_solid">
		<div class="item"><span class="tag">收货地址</span><span class="content">广东深圳市南山区</span></div>
	</div>
	<form action="" method="post" class="ajaxForm">
	<div class="payment_info_bar">
		<div class="item"><span class="tag">订单号</span><span class="content">os201505131650223943</span></div>
		<hr class="gray_solid">
		<div class="item"><span class="tag">交易金额</span><span class="content price">213.00元</span></div>
	</div>
	<div class="payment_info_bar">
		<div class="item">
			<span class="img"><img src="images/sale/icon_alipay.png"></span>
			<a class="checkbox right" href="javascript:void(0)" id="alipay"></a>
		</div>
        <hr class="gray_solid">
        <div class="item">
			<span class="img"><img src="images/sale/icon_weixin.jpg"></span>
			<a class="checkbox right" href="javascript:void(0)" id="weixin"></a>
		</div>
	</div>
	<div class="payment_btn_bar">
		<button class="submit">确认支付</button>
		<input name="payType" id="payType" value="tftpay" type="hidden">
		<input name="sn" id="sn" value="os201505131650223943" type="hidden">
	</div>

</div>

<style type="text/css">
/* ------------------------------------------------ 头部 ------------------------------------ */

header{
	background: #337ab7;
	color: white;
	text-align: center;
	margin: 0px;
	padding: 0px;
	display: table;
	width: 100%;
}

/* ------------------------------------------------ 头部 ------------------------------------ */
</style>



<script type="text/javascript">
$(function(){
	// 详情页tab按钮
	$(document).on("click", ".tab .item", function(e){
		$(".tab .item").removeClass("active");
		var target = $(this).addClass("active").data("target");
		$(".detail_block").hide();
		$(".comment_block").hide();
		$("." + target).show();
	});
	
		// 详情页评价按钮
	$(document).on("click", ".status .item", function(e){
		$(".status .btn").removeClass("active");
		var target = $(this).addClass("active").data("target");
		$(".detail_block").hide();
		$(".comment_block").hide();
		$("." + target).show();
	});
});


</script>


