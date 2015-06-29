<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "购物车";
$this->registerCssFile ( 'css/sale/header.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/cart.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/shopcart.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/goods.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );

?>

<form action="<?=Url::toRoute(['/sale/vip-order/confirm'])?>"
	id="shopping_cart_form" method="post">
	<input type="hidden" name="_csrf"
		value="<?= @Yii::$app->request->csrfToken ?>" />
	<div class="vip-cart-form" style="margin: 10px;">
		<div class="cart_item_bar">
			<div class="title"></div>
			<hr class="gray_solid">
		<?php foreach ($detailList as $i=>$shoppingCart) {?>
			<div class="cart_item" id="cart_item_<?=$shoppingCart['id']?>">
				<input type="hidden" value="<?=$shoppingCart->product['id']?>"
					name="detailList[<?=$i?>][product_id]"> <input type="hidden"
					value="1" name="detailList[<?=$i?>][checked]"
					id="detailList_<?=$shoppingCart['id']?>_checked">
				<div class="info_block">
					<a cart_id ='<?=$shoppingCart['id']?>' style="top: 41px;"
						class="checkbox checkboxitem checkboxvisible checkbox_checked"
						href="javascript:void(0)"></a>
					<div class="img"
						style="width: 80px; height: 80px; margin-right: 5px;">
						<a
							href="<?php echo Url::toRoute(['/sale/product/view','id'=>$shoppingCart->product['id']]); ?>">
							<img style="width: 70px; height: 70px;"
							src="<?php
			if (isset ( $shoppingCart->product->primaryPhoto )) {
				echo Url::toRoute ( [ 
						'/sale/product-photo/view',
						'id' => $shoppingCart->product ['primaryPhoto'] ['id'] 
				] );
			}
			?>">
						</a>
					</div>

					<div class="info_title" style="width: 60%">
						<div class="name" style="padding: 0">
							<a style="text-decoration: none;"
								href="<?php echo Url::toRoute(['/sale/product/view','id'=>$shoppingCart->product['id']]); ?>"><?= $shoppingCart->product['name']?></a>
						</div>
						<div class="price" style="color: gray; position: relative;">
							￥<span class="price_val" style="color: gray;"><?= round($shoppingCart->product['price'],2)?></span>
						</div>
						<div class="number_bar" style="display: block; overflow: visible;">
							<div class="calc"
								style="display: block; border-radius: 0px; margin: 0px; height: 40px; width: 120px;">
								<span class="counter"> <a class="reduce link_reduce_quantity"
									href="javascript:void(0)" cart_id ='<?=$shoppingCart['id']?>'><img
										src="images/sale/icon_calc_reduce.png"></a> 
										<input type="text"
									class="num buy_quantity" value="<?=$shoppingCart->quantity ?>"
									name="detailList[<?=$i?>][quantity]"
									id="detailList_<?=$shoppingCart['id']?>_quantity" cart_id ='<?=$shoppingCart['id']?>'/> <a
									class="add link_add_quantity" href="javascript:void(0)"
									cart_id ='<?=$shoppingCart['id']?>'><img src="images/sale/icon_calc_add.png"></a>
								</span>
							</div>
						</div>
						<a class="delete link_delete_item" href="javascript:void(0)"
							style="right: 0; position: absolute;" cart_id ='<?=$shoppingCart['id']?>'><img
							style="height: 30px; width: 30px;"
							src="images/sale/icon_delete.png"></a>
					</div>

				</div>
				<hr class="gray_solid">
			</div>
		<?php }?>
		
		<!-- 
		<div class="statistic_block">
			<span>共1件 </span> <span>合计：</span> <span><strong>￥<span
					class="total_val">368</span></strong></span> <input name="is_cart"
				id="is_cart" value="0" type="hidden">
		</div>
		 -->
		</div>
		<div class="cart_btn_bar_placeholder"></div>
		<div class="cart_btn_bar" style="padding: 0">
			<a class="checkbox checkboxall checkboxvisible checkbox_checked"
				href="javascript:void(0)"></a><label>&nbsp;全选</label> 共<span id="total_order_quantity">1</span>件
			<a href="javascript:void(0)"><button class="submit" id="btn_buy" style="">结算</button></a>
			<span class="total"><font color="#e4393c">总计：￥<span class="all_total" id="total_order_amt">368</span></font>
			</span>
		</div>

	</div>



</form>

	<script type="text/javascript">
$(function(){
	$('#btn_buy').click(function(){
		$("#shopping_cart_form").submit();
	});	

	$('.link_reduce_quantity').click(function(){
		//var cart_id = $(this).prop('cart_id');
		console.debug(cart_id);
		var cart_id = $(this).attr('cart_id');
		console.debug(cart_id);
    
		
		var buy_quantity = $('#buy_quantity').val();
		var quantity = 1;
		if(/^[0-9]*[1-9][0-9]*$/.test(buy_quantity) == false){
			quantity = 1;
		}else {
			if(buy_quantity>1){
				quantity = parseInt(buy_quantity) -1; 
			}
		}
		$('#buy_quantity').val(quantity);
		
	});

	
});


</script>