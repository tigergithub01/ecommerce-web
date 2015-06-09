<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "订单详情";
$this->registerCssFile ('css/sale/header.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/order.css',['position' => \yii\web\View::POS_HEAD] );

?>


<div class="vip-order-detail-form" style="margin: 10px;">
	<div class="order_detail_status">
		<div class="item">	
			<div class="title">待付款</div>
			<div class="content">订单金额（含运费）：￥213.00</div>
			<div class="content">运费：￥0.00</div>
		</div>
		<div class="item"><hr class="gray_solid"></div>
		<div class="item">
			<div class="title">收货人：郭生 13724346621</div>
			<div class="content">收货地址：广东深圳市南山区科技园A8大厦</div>
		</div>
		<div class="item"><hr class="gray_solid"></div>
		<div class="item">
			<div class="title">买家留言：</div>
			<div class="content">&nbsp;</div>
		</div>
	</div>
	<div class="order_item_bar">
		<div class="title">
			<a class="left" href="#">云商微店 </a>
		</div>
		<hr class="gray_solid">
			<div class="info_block">
				<div class="img"><img src="%E8%AE%A2%E5%8D%95%E8%AF%A6%E6%83%85-%E6%8F%90%E4%BA%A4%E5%90%8E%E6%9F%A5%E7%9C%8B_files/s_55239527bef52.jpg"></div>
				<div class="info_title">
					<div class="name">中大鳄鱼男士鞋春夏季新品潮流鞋子白运动休闲板鞋男韩版防滑透气</div>
						<div class="standard">规格：<span>×10</span></div>
						<div class="price1">￥100.00</div>
				</div>
                <!---------------
				<div class="info_price">
					<div class="price">￥213.00</div>
					<div class="num">×1</div>
				</div>
                ----------------->
			</div>		<hr class="gray_solid">
		<div class="statistic_block">
			<span>共1件 </span>
			<span>运费：0.00 </span>
			<span>实付：</span>
			<span class="price">￥213.00</span>
		</div>
		<hr class="gray_solid">
		<div class="trade_block">
			<div>卖家： 13724346621</div>
			<div>卖家地址：os201505131650223943</div>
            <div>订单号：os201505131650223943</div>
    		<div>下单时间：2015-05-13 16:50</div>
			<div>付款时间：-</div>
			<div>成交时间：-</div>
		</div>
	</div>
	<div class="detail_btn_bar">
		<a class="default danger" href="javascript:void(0)" onclick="confirm_url('确定要取消此订单吗？','')">取消订单</a>
			<a class="default primary" href="">付款</a>
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
	$(".info_block").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/product/view'])?>';	
	});		
});


</script>


