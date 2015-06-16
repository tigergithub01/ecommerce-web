<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "订单列表";
$this->registerCssFile ( 'css/sale/common.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/orderlb.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/header.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/order.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
?>


<div class="vip-order-form" style="margin: 2px;">
	<!-- 
	<header data-role="header" class="nav">
		<ul class="box" id="Menu">
			<li><a class="on" href="javascript:;"
				onclick="change_bg(this);zxb(0)">待支付</a></li>

			<li><a href="javascript:;" onclick="change_bg(this);zxb(1)" class="">待发货</a>
			</li>

			<li><a class="" href="javascript:;" onclick="change_bg(this);zxb(2)">待收货</a>
			</li>

			<li><a class="" href="javascript:;" onclick="change_bg(this);zxb(3)">待评价</a>
			</li>

			<li><a class="" href="javascript:;" onclick="change_bg(this);zxb(4)">已完成</a>
			</li>

		</ul>
	</header>
	 -->
	<section id="0" style="display: block;">
		<?php foreach ($orderList as $order) {?>
		<div class="order_item_bar">
			订单编号：<?php echo $order['code']?>&nbsp; </br>
			订单金额：<?php echo $order['order_amt']?>&nbsp; </br>
			订购数量：<?php echo $order['order_quantity']?></br>
			订单状态: <?php echo $order['order_status']['pa_val']?></br>
			订单提交日期：<?php echo $order['order_date']?>
		</div>
		<hr class="gray_solid" style="margin-left: 12px;">
		<?php if ($order['status']==3001){?>
		<div class="detail_btn_bar">
			<a class="default primary"
				href="<?=Url::toRoute(['/sale/vip-order/view','orderId'=>$order['id']])?>">查看订单</a>
			<a class="default primary"
				href="<?=Url::toRoute(['/sale/vip-order/confirm','orderId'=>$order['id']])?>">付款</a>
		</div>
		<?php }?>
		<?php }?>
		
	</section>
	<footer data-role="footer">
		<div class="home-menu" id="container">
			<div class="widget_wrap">
				<ul class="box" id="Menu">
					<li><a onclick="foot_bg(this)"
						href="<?=Url::toRoute(['/sale/vip-center/index'])?>" class=""><span>&nbsp;</span><label>个人中心</label></a>
					</li>
				</ul>
			</div>
		</div>

	</footer>

</div>

<style type="text/css">

</style>




<script type="text/javascript">
$(function(){
	$(".info_block").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/vip-order/view'])?>';	
	});	
});


</script>


