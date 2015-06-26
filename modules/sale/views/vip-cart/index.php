<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "购物车";
$this->registerCssFile ('css/sale/header.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/cart.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/shopcart.css',['position' => \yii\web\View::POS_HEAD] );

?>


<div class="vip-cart-form" style="margin: 10px;">
	<div class="cart_item_bar">
			<div class="title">
			</div>
			<hr class="gray_solid">
				<div class="info_block">
						<a style="top: 41px;" class="checkbox checkboxitem checkboxvisible checkbox_checked" href="javascript:void(0)"></a>
						<div class="img"><img src=""></div>
						<div class="info_title">
							<div class="name">丽瓦丽干红<input checked="checked" id="cart_id-56765-12891_0" name="cart_id[56765][12891_0]" class="chkbox" value="12891_0" style="display:none" type="checkbox"></div>
								<div class="standard">规格：<span>×<span class="num_val">1</span></span></div>
							<input name="cart_size[56765][12891_0]" value="" type="hidden">
							<div class="price">￥<span class="price_val">368.00</span></div>
							<!-- 
							<a class="button delete_item" href="javascript:void(0)"><img src="images/sale/icon_delete_bg.png"></a>
							 -->
						</div>
						
						<div class="calc">
							<a class="button reduce" href="javascript:void(0)">-</a>
							<div class="input"><input value="1" name="cart_num[56765][12891_0]" id="num-56765-12891_0" data-stock="200" class="num_box" type="text"></div>
							<a class="button add" href="javascript:void(0)">+</a>
						</div>
						<div class="del_bar">
							<a class="button delete_item" href="javascript:void(0)"><img src="images/sale/icon_delete_bg.png"></a>
						</div>
						<!-- <div class="info_price">
							 
							<div class="price">￥<span class="price_val">368.00</span></div>
							 
							<div class="price">&nbsp;</div>
							<div class="num">×<span class="num_val">1</span></div>
						</div>-->
					</div>			<hr class="gray_solid">
			<div class="statistic_block">
				<span>共1件 </span>
				<span>合计：</span>
				<span><strong>￥<span class="total_val">368</span></strong></span>
				<input name="is_cart" id="is_cart" value="0" type="hidden">
			</div>
		</div>	<div class="cart_btn_bar_placeholder"></div>
	<div class="cart_btn_bar">
		<a class="checkbox checkboxall checkboxvisible checkbox_checked" href="javascript:void(0)"></a><label>&nbsp;全选</label>
		<a class="delete"><img src="images/sale/icon_delete.png"></a>
		<button class="submit">结算</button>
		<span class="total">总计：￥<span class="all_total">368</span> </span>
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
		
});


</script>


