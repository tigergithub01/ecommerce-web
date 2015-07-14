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

$this->registerCssFile ( 'css/sale/product.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerJsFile('js/sale/jquery.blockUI.js', [ 
		'position' => \yii\web\View::POS_END 
]);
?>

<form action="<?=Url::toRoute(['/sale/vip-order-confirm/create'])?>"
	id="shopping_cart_form" method="post">
	<input type="hidden" name="_csrf"
		value="<?= @Yii::$app->request->csrfToken ?>" />
	<div class="vip-cart-form wrapper" style="margin: 10px;">
		<div class="cart_item_bar">
			<div class="title"></div>
			<hr class="gray_solid">
			<div style="text-align: center;font-size:20px;"><?php if (empty($detailList)){?>您的购物车中没有数据<?php } ?></div>
		<?php foreach ($detailList as $i=>$shoppingCart) {?>
			<div class="cart_item" id="cart_item_<?=$shoppingCart['id']?>" cart_id ='<?=$shoppingCart['id']?>' >
				<input type="hidden" value="<?=$shoppingCart->product['id']?>"
					name="detailList[<?=$i?>][product_id]"> <input type="hidden"
					value="1" name="detailList[<?=$i?>][checked]" class="detailList_checked"
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
							<input type="hidden" value="<?= $shoppingCart->product['id']?>" id="detailList_<?=$shoppingCart['id']?>_product_id"> 	
						</div>
						<div class="price" style="color: gray; position: relative;">
							￥<span class="price_val" style="color: gray;"><?= round($shoppingCart->product['price'],2)?></span>
							<input type="hidden" value="<?= round($shoppingCart->product['price'],2)?>" id="detailList_<?=$shoppingCart['id']?>_price"> 
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
		<div class="cart_btn_bar bottom_bar" style="padding: 0">
			<a class="checkbox checkboxall checkboxvisible checkbox_checked"
				href="javascript:void(0)"></a><label>&nbsp;全选</label> 共<span id="total_order_quantity"><?= $total_quantity ?></span>件
			<a href="javascript:void(0)"><button class="submit" id="btn_buy" style="">结算</button></a>
			<span class="total" style="padding-right: 2px;"><font color="#e4393c">总计：￥<span class="all_total" id="total_order_amt"><?= round($total_amt,2)?></span></font>
			</span>
		</div>

	</div>



</form>

	<script type="text/javascript">
$(function(){
// 	$(document).ajaxStart($.blockUI({ css: { backgroundColor: '#f00', color: '#fff'} })).ajaxStop($.unblockUI);
	
	
	$('#btn_buy').click(function(){
		var total_quantity = 0;
		$.each($('.cart_item'),function(i,v){
			var cart_id = $(v).attr('cart_id');
			var quantity = $('#'+'detailList_'+cart_id+'_quantity').val();
			$detailList_checked_item = $('#'+'detailList_'+cart_id+'_checked');
			if($detailList_checked_item.val()==1){
				total_quantity = total_quantity + parseInt(quantity);
			}
		});
		if(total_quantity==0){
			alert('请选择需要购买的商品。');
			return false;
		}
		$.blockUI({ message: '<span style="text-align:center"><img src="/images/sale/img_loading.png" /><div>处理中,请稍等...</div></span>' });
		$("#shopping_cart_form").submit();
	});	

	$("#shopping_cart_form").submit(function(){
		return true;
	});

	$('.link_reduce_quantity').click(function(){
		//var cart_id = $(this).prop('cart_id');
// 		console.debug(cart_id);
		var cart_id = $(this).attr('cart_id');
// 		console.debug(cart_id);
    
		var $quantity_input = $('#'+'detailList_'+cart_id+'_quantity');
		var buy_quantity = $quantity_input.val();
		var quantity = 1;
		if(/^[0-9]*[1-9][0-9]*$/.test(buy_quantity) == false){
			quantity = 1;
		}else {
			if(buy_quantity>1){
				quantity = parseInt(buy_quantity) -1; 
			}
		} 
		$quantity_input.val(quantity);

		var product_id = $('#'+'detailList_'+cart_id+'_product_id').val();
		updateShoppingCart(cart_id, product_id, quantity);
// 		recomputeTotal();
	});

 
	$('.link_add_quantity').click(function(){
		var cart_id = $(this).attr('cart_id');
		var $quantity_input = $('#'+'detailList_'+cart_id+'_quantity');
		var buy_quantity = $quantity_input.val();
		var quantity = 1;
		if(/^[0-9]*[1-9][0-9]*$/.test(buy_quantity) == false){
			quantity = 1;
		}else{
			quantity = parseInt(buy_quantity) +1; 
		}
		//console.debug(quantity);
		$quantity_input.val(quantity);
			
// 		recomputeTotal();
		var product_id = $('#'+'detailList_'+cart_id+'_product_id').val();
		updateShoppingCart(cart_id, product_id, quantity);
	});

	$('.buy_quantity').change(function(){
		var buy_quantity = $(this).val();
		var quantity = buy_quantity;
// 		console.debug(buy_quantity);
		if(/^[0-9]*[1-9][0-9]*$/.test(buy_quantity) == false){
			quantity = 1;
		}
		$(this).val(quantity);
		
		var cart_id = $(this).attr('cart_id');
		var product_id = $('#'+'detailList_'+cart_id+'_product_id').val();
// 		recomputeTotal();
		updateShoppingCart(cart_id, product_id, quantity);
	});

	$('.checkboxall').click(function(){
		$(this).toggleClass('checkbox_checked');
		if($(this).hasClass('checkbox_checked')){
			$(".checkboxitem").addClass('checkbox_checked');	
			$(".detailList_checked").val(1);
		}else{
			$(".checkboxitem").removeClass('checkbox_checked');	
			$(".detailList_checked").val(0);
		}

		recomputeTotal();
	});

	$('.checkboxitem').click(function(){
		$(this).toggleClass('checkbox_checked');
		var cart_id = $(this).attr('cart_id');

		//set checked val
		$detailList_checked_item = $('#'+'detailList_'+cart_id+'_checked');
		if($(this).hasClass('checkbox_checked')){
			$detailList_checked_item.val(1);
		}else{
			$detailList_checked_item.val(0);
		}

		var allChecked  = true;
		$.each($('.checkboxitem'),function(i,v){
			if(!$(v).hasClass('checkbox_checked')){
				allChecked = false;
				return false;
			}
		});
		if(allChecked){
			$(".checkboxall").addClass('checkbox_checked');	
		}else{
			$(".checkboxall").removeClass('checkbox_checked');	
		}		

		recomputeTotal();
	});


	$('.link_delete_item').click(function(){
		if(!confirm('是否从购物车中移除?')){
			return false;
		}
		var cart_id = $(this).attr('cart_id');
		var $cart_item = $('#'+'cart_item_'+cart_id);
		$cart_item.remove();

		deleteShoppingCart(cart_id);
// 		recomputeTotal();
	});
	

	
});

function deleteShoppingCart(cart_id){
	$.blockUI({ message: '<span style="text-align:center"><img src="/images/sale/img_loading.png" /><div>处理中,请稍等...</div></span>' });
	$.ajax({     
	    url:'<?=Url::toRoute(['/sale/vip-cart/ajax-delete'])?>',     
	    type:'post',  
	    dataType:'json', 
	    data:{
	    	'id':cart_id,
	    	'_csrf':'<?= @Yii::$app->request->csrfToken ?>'
	    	},     
	    async :true, 
	    error:function(){ 
	    	 $.unblockUI();     
	       alert('更新数据失败');    
	    },     
	    success:function(data){ 
		    if(data.status==1){
		    	recomputeTotal();
		    }
		    $.unblockUI(); 
	    	
	    }  
	}); 
}

function updateShoppingCart(cart_id,product_id,quantity){
// 	$.blockUI();
	$.blockUI({ message: '<span style="text-align:center"><img src="/images/sale/img_loading.png" /><div>处理中,请稍等...</div></span>' });
	$.ajax({     
	    url:'<?=Url::toRoute(['/sale/vip-cart/ajax-update'])?>',     
	    type:'post',  
	    dataType:'json', 
	    data:{
	    	'id':cart_id,
	    	'ShoppingCart[product_id]':product_id,
	    	'ShoppingCart[quantity]':quantity,
	    	'_csrf':'<?= @Yii::$app->request->csrfToken ?>'
	    	},     
	    async :true, 
	    error:function(){    
	       $.unblockUI(); 
	       alert('更新数据失败');    
	    },     
	    success:function(data){ 
		    if(data.status==1){
		    	recomputeTotal();
		    }
		    $.unblockUI();
	    }  
	}); 
}

function recomputeTotal(){
	var total_amt=0;
	var total_quantity=0;
	$.each($('.cart_item'),function(i,v){
		var cart_id = $(v).attr('cart_id');
		var quantity = $('#'+'detailList_'+cart_id+'_quantity').val();
		var price = $('#'+'detailList_'+cart_id+'_price').val();
		$detailList_checked_item = $('#'+'detailList_'+cart_id+'_checked');
		if($detailList_checked_item.val()==1){
			total_amt = total_amt + parseInt(quantity) * parseFloat(price);
			total_quantity = total_quantity + parseInt(quantity);
		}
	});

	total_amt = Math.round(total_amt*100)/100;
	$('#total_order_quantity').text(total_quantity);
	$('#total_order_amt').text(total_amt);

}



</script>