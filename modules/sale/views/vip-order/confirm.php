<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "订单支付";
$this->registerCssFile ( 'css/sale/header.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/payment.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );

?>


<div class="vip-center-form" style="margin: 10px;">
	<div class="payment_info_bar">
		<div class="item">
			<span class="tag">收货人</span><span class="content"><?php echo $model['soContactPerson']['name']?> <?php echo $model['soContactPerson']['phone_number']?></span>
		</div>
		<hr class="gray_solid">
		<div class="item">
			<span class="tag">收货地址</span><span class="content"><?php echo $model['soContactPerson']['province']['name'].$model['soContactPerson']['city']['name'].$model['soContactPerson']['district']['name'].$model['soContactPerson']['detail_address']?></span>
		</div>
	</div>
	<form action="<?php echo Url::toRoute('/sale/vip-order/confirm')?>" method="post" class="ajaxForm" id="order_detail_form">
		<div class="payment_info_bar">
			<div class="item">
				<span class="tag">订单号</span><span class="content"><?php echo $model['code']?></span>
			</div>
			<hr class="gray_solid">
			<div class="item">
				<span class="tag">交易金额</span><span class="content price"><?php echo floor($model['order_amt']*100)/100 ?>元</span>
			</div>
		</div>
		<div class="payment_info_bar">
			<div class="item">
				<span class="img"><img src="images/sale/icon_alipay.png"></span> <a
					class="checkbox right" href="javascript:void(0)" id="btn_alipay"></a>
			</div>
			<hr class="gray_solid">
			<div class="item">
				<span class="img"><img src="images/sale/icon_weixin.jpg"></span> <a
					class="checkbox right" href="javascript:void(0)" id="btn_weixin"></a>
			</div>
		</div>
		<div class="payment_btn_bar">
			<button class="submit">确认支付</button>
			<input name="pay_type_id" id="pay_type_id" type="hidden"> 
			<input name="so_order_id" id="so_order_id" value="<?php echo $model['code']?>" type="hidden">
		</div>

</div>

<style type="text/css">
/* ------------------------------------------------ 头部 ------------------------------------ */
header {
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
	$('a.checkbox').click(function(){
		$('a.checkbox').removeClass('checkbox_checked');
		$(this).addClass('checkbox_checked');
		if($(this).attr('id')=='btn_alipay'){
			$('#pay_type_id').val(1);
		}else if($(this).attr('id')=='btn_weixin'){
			$('#pay_type_id').val(2);
		}
		
	});

	$('#order_detail_form').submit(function(){
		if($('a.checkbox_checked').length==0){
			alert('请选择支付方式.');	
			return false;
		}
	});
	
});


</script>


