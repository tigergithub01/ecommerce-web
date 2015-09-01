<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "订单详情";
$this->registerCssFile ('css/sale/header.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/order.css',['position' => \yii\web\View::POS_HEAD] );

?>


<div class="vip-order-detail-form wrapper" style="margin: 10px;">
	<div class="order_detail_status">
		<div class="item">
			<div class="title"><?php echo $model['order_status']['pa_val']?></div>
			<div class="content">订单金额：￥<?php echo floor($model['order_amt']*100)/100 ?></div>
			<!-- 
			<div class="content">运费：￥0.00</div>
			 -->
		</div>
		<div class="item">
			<hr class="gray_solid">
		</div>
		<div class="item">
			<div class="title">收货人：<?php echo $model['soContactPerson']['name']?> <?php echo $model['soContactPerson']['phone_number']?></div>
			<div class="content">收货地址：<?php echo $model['soContactPerson']['province']['name'].$model['soContactPerson']['city']['name'].$model['soContactPerson']['district']['name'].$model['soContactPerson']['detail_address']?></div>
		</div>
		<!--  
		<div class="item">
			<hr class="gray_solid">
		</div>
		<div class="item">
			<div class="title">买家留言：</div>
			<div class="content">&nbsp;</div>
		</div>
		-->
	</div>
	<div class="order_item_bar">
		<?php foreach ($model['soDetailList'] as $soDetail) {?>
		
		<div class="info_block">
			<div class="img">
				<a href="<?=Url::toRoute(['/sale/product/view','id'=>$soDetail['product']['id']])?>">
				<img
					src="<?php echo Url::toRoute(['/sale/product-photo/view','id'=>$soDetail['product']['primaryPhoto']['id']])?>">
					</a>
			</div>
			<div class="info_title">
				<div class="name"><?php echo $soDetail['product']['name'] ?></div>
				<div class="standard">
					数量：<span><?php echo $soDetail['quantity']?></span>
				</div>
				<div class="price1">￥<?php echo round($soDetail['amount'],2)?></div>
			</div>
			<!---------------
				<div class="info_price">
					<div class="price">￥213.00</div>
					<div class="num">×1</div>
				</div>
                ----------------->
		</div>
		<hr class="gray_solid">
		<?php }?>
		
		
		<div class="statistic_block">
			<span>共<?php echo $model['order_quantity']?>件 </span>  <span>实付：</span> <span
				class="price">￥<?php echo round($model['order_amt'],2)?></span>
		</div>
		<hr class="gray_solid">
		<div class="trade_block">
			<div>下单时间：<?php echo $model['order_date']?></div>
			<div>付款时间：<?php echo $model['pay_date']?></div>
			<!-- 
			<div>成交时间：-</div>
			 -->
		</div>
	</div>
	<div class="detail_btn_bar">
		<!-- 
		<a class="default danger" href="javascript:void(0)"
			onclick="confirm_url('确定要取消此订单吗？','')">取消订单</a>
		 -->
		 <?php if ($model['status']==3001 || $model['status']==3002){?>
			<a
			class="default primary" onclick="return confirm('是否取消订单?');" href="<?=Url::toRoute(['/sale/vip-order/cancel','orderId'=>$model['id']])?>">取消订单</a>
		 <?php }?>
		 
		 <?php if ($model['status']==3001){?>
		 <a
			class="default primary" href="<?=Url::toRoute(['/sale/vip-order/pay','orderId'=>$model['id']])?>">付款</a>
		<?php }?>	
		
		
		<?php if ($model['status']==3003){?>	
			<a
			class="default primary" onclick="return confirm('是否确认收货?');" href="<?=Url::toRoute(['/sale/vip-order/rev-confirm','orderId'=>$model['id']])?>">确认收货</a>
		<?php }?>
	</div>

</div>




<script type="text/javascript">
$(function(){
		
});

function cancelOrder(url){
	if(!confirm('是否取消订单')){
		return false;
	}
	window.location.href=url;
}

function receiveOrder(url){
	if(!confirm('是否确认收货')){
		return false;
	}
	window.location.href=url;
}


</script>


