<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "订单列表";
$this->registerCssFile ( 'css/sale/header.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/order.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
?>


<div class="vip-order-form wrapper" style="margin: 2px;">
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
		<?php if (empty($orderList)){?>
			<div style="text-align: center;">
			没有符和条件的订单!
			</div>
		<?php }?>
		<?php foreach ($orderList as $order) {?>
		<div class="order_item_bar" style="cursor: pointer;" order_id="<?=$order['id']?>">
			<div class="img"
						style="width: 80px; height: 80px; margin-right: 5px;float: left;">
						<a
							href="javascript:void(0)">
							<img style="width: 70px; height: 70px;"
							src="<?php
			if (isset ( $order->soDetailList[0]->product->primaryPhoto )) {
				echo Url::toRoute ( [ 
						'/sale/product-photo/view',
						'id' => $order->soDetailList[0]->product ['primaryPhoto'] ['id'] 
				] );
			}
			?>">
						</a>
					</div>
					<div>
						<div>
							￥<?= round($order['order_amt'],2)?>
						</div>
						<div>
							<?php if (isset ( $order->soDetailList[0]->product )) {
								echo $order->soDetailList[0]->product['name'];
}?>
						</div>
						<div>
							<?= $order['order_date']?>
						</div>
					</div>
					
		
		<div class="detail_btn_bar" style="text-align: right: ;">
			<a class="default primary"
				href="<?=Url::toRoute(['/sale/vip-order/view','orderId'=>$order['id']])?>">查看订单</a>
			
				<?php if ($order['status']==3001){?>
					<a class="default primary" style="background-color: #c00000"
						href="<?=Url::toRoute(['/sale/vip-order/pay','orderId'=>$order['id']])?>">付款</a>
				<?php } else if($order['status']==3003){?>
				<!-- 
					<a class="default primary" style="background-color: #c00000" onclick="return confirm('是否确认收货?');" 
						href="<?=Url::toRoute(['/sale/vip-order/rev-confirm','orderId'=>$order['id']])?>">确认收货</a>
						 -->
				<?php }?>
				
		</div>
		
			
			<!-- 
			订单编号：<?php echo $order['code']?>&nbsp; </br>
			订单金额：<?php echo $order['order_amt']?>&nbsp; </br>
			订购数量：<?php echo $order['order_quantity']?></br>
			订单状态: <?php echo $order['order_status']['pa_val']?></br>
			订单提交日期：<?php echo $order['order_date']?>
			 -->		
		</div>
		
		<?php }?>
		
	</section>
	<!-- 
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
	 -->
</div>

<style type="text/css">

</style>




<script type="text/javascript">
$(function(){
	$(".order_item_bar").click(function(){
		var order_id = $(this).attr("order_id");
		window.location.href='<?=Url::toRoute(['/sale/vip-order/view'])?>&orderId='+order_id;	
	});	
});


</script>


