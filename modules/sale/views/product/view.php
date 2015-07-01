<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\modules\sale\models\SaleConstants;

$this->title = "产品详情";
$this->registerCssFile ( 'css/sale/header.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'css/sale/goods.css', [ 
		'position' => \yii\web\View::POS_HEAD 
] );
$this->registerCssFile ( 'js/sale/slidebox/jquery.slideBox.css', [ 
		'position' => \yii\web\View::POS_END 
] );

$this->registerJsFile ( "js/sale/slidebox/jquery.slideBox.js", [ 
		'position' => \yii\web\View::POS_END 
] );
$this->registerJsFile('js/sale/jquery.blockUI.js', [
		'position' => \yii\web\View::POS_END
]);
?>

<form action="<?=Url::toRoute(['/sale/vip-order-confirm/create'])?>"
	id="product_detail_form" method="post">
	<input type="hidden" name="_csrf"
		value="<?= @Yii::$app->request->csrfToken ?>" />

	<div class="vip-center-form">

		<div id="photo_slideBox" class="slideBox">
			<ul class="items">
  <?php foreach ($photoList as $photo){?>
  		<li><a href="javascript:void(0)" title=""><img style="width: 100%"
						height="300px"
						src="<?php echo Url::toRoute(['/sale/product-photo/view','id'=>$photo['id']])?>"></a></li>
  <?php } ?>
  </ul>
		</div>




		<div class="goods_info_bar">
			<div class="title">
				<span class="btl"><?php echo $model['name']?></span> <span
					class="scr"> <!-- 
				<?php if(!isset($_SESSION[SaleConstants::$session_vip])){?>
				<img src="images/sale/collect.png" class="fav_goods"
				id="btn_collect">
				<?php }?>
				 -->
			
			</div>

			<div class="sale_info">
				<span class="price">售价：<span class="value">￥<?php echo round($model['price'],2)?></span></span>
			</div>
			<div class="number_bar">
				<div class="calc" style="padding: 0 16px 8px">
					<span class="buynber">数量：</span> <span class="counter"> <a
						class="reduce" id="link_reduce_quantity" href="javascript:void(0)"><img
							src="images/sale/icon_calc_reduce.png"></a> <input class="num"
						value="1" name="detailList[0][quantity]" id="buy_quantity"
						type="text"> <a class="add" id="link_add_quantity"
						href="javascript:void(0)"><img src="images/sale/icon_calc_add.png"></a>
					</span>
					<!-- 
							</span> <span class="stock">(库存<span class="s_stock">200</span>件)
							</span> <input value="12891" name="gid" id="gid" type="hidden"> <input
								value="56765" name="usid" id="usid" type="hidden">
							 -->

				</div>
			</div>
			<hr class="gray_solid">
		</div>
		<!-- 
	<div class="standard_bar">

		<div class="panel">

			<div class="standard">
				<div class="color row">
					<div class="thumb">
						<img
							src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/s_552394a32bea8.jpg">
					</div>
					<div class="info">
						<span class="price">￥<span class="s_price">368.00</span></span><span
							class="gray"> 
						</span><br> <span class="gray">请选择规格</span>
					</div>
					<div class="btn_close">
						<a href="javascript:void(0)"><img
							src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_close.png"></a>
					</div>
				</div>
				<div id="hqwznr">
					<div class="shuxing">规格</div>
					<div class="yansxz">
						<div class="xzys active" data-id="" data-price="368.00"
							data-stock="200">
							<a class="" href="javascript:void(0)"></a>
						</div>
					</div>

					<div class="number_bar">
						<div class="calc">
							<span class="buynber">数量：</span> <label class="tag"></label> <span
								class="counter"> <a class="reduce" href="javascript:void(0)"><img
									src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_calc_reduce.png"></a>
								<input class="num" value="1" name="num" id="number" type="text">
								<a class="add" href="javascript:void(0)"><img
									src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_calc_add.png"></a>
							</span> <span class="stock">(库存<span class="s_stock">200</span>件)
							</span> <input value="12891" name="gid" id="gid" type="hidden"> <input
								value="56765" name="usid" id="usid" type="hidden">
						</div>
					</div>
				</div>
				

				<div class="size center">
					<button class="button primary btn-sure" data-oper="buy">立刻购买</button>
				</div>
			</div>
		</div>
		<div class="bg"></div>
	</div>
 -->



		<div class="goods_detail_bar">
			<div class="tab">
				<!----<a class="item_full left" data-target="detail_block" href="javascript:void(0)">图文详情</a>----->

				<a class="item rborder active" data-target="detail_block"
					href="javascript:void(0)">图文详情</a>
				<!-- 
			<a class="item"
				data-target="comment_block" href="javascript:void(0)">用户评价<span
				class="danger">（0）</span></a>
			 -->

			</div>
			<div class="detail_block">
				<div class="detail_content"><?php echo $model['description']?></div>
				<div class="img_block" id="aa2">
				 <?php foreach ($photoList as $photo){?>
				  		<img
						src="<?php echo Url::toRoute(['/sale/product-photo/view','id'=>$photo['id']])?>">
				  <?php } ?>
			</div>
			</div>

			<!---------------------评价---------------------------->
			<!-- 
		<div class="comment_block">
			<div class="status" id="Menuaa">
				<a class="btn active" href="javascript:void(0)"
					onclick="comment_switch(this)" data-level="0" data-count="0">全部</a>
				<a class="btn" href="javascript:void(0)"
					onclick="comment_switch(this)" data-level="1" data-count="0"><img
					src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_comment_good.png"><span>好评（0）</span></a>
				<a class="btn" href="javascript:void(0)"
					onclick="comment_switch(this)" data-level="2" data-count="0"><img
					src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_comment_normal.png"><span>中评（0）</span></a>
				<a class="btn" href="javascript:void(0)"
					onclick="comment_switch(this)" data-level="3" data-count="0"><img
					src="%E4%B8%BD%E7%93%A6%E4%B8%BD%E5%B9%B2%E7%BA%A2_files/icon_comment_bad.png"><span>差评（0）</span></a>
			</div>
			<div class="comment_list">
				
			</div>
		</div>
		 -->


		</div>
		<div class="open_bar">
			<!-- 
		<div class="content">平台自带强大的供应商系统，可以让你0库存、免发货，还可以发展连锁分店，收益多多，赶快来开免费微店吧！</div>
		 -->
			<!----------------------------开店star----------------------------------->
			<!----<div class="bottom-nav">
                    <ul>
                        <li><a href="/wap.php/web/index/usid/56765.html">店铺首页</a></li>
                        <li><a href="/wap.php/user/index/usid/56765.html">个人中心</a></li>
                        <li class="qubian"><a href="/wap.php/reg/index/invite_mobile/13724346621" target="_blank">免费开云商店</a></li>
                    </ul>
       </div>---->

			<!-- 
      <div class="goods_btn_mfkysd"><a href="http://ysk.xmgapay.com/wap.php/reg/index/invite_mobile/13724346621" target="_blank">免费开云商微店</a></div>
       -->
			<!----------------------------开店end----------------------------------->
		</div>
		<div id="img_view_bar" class="img_view_bar">
			<div class="img_view_bar_bg"></div>
			<div class="img_view_bar_container"></div>
			<!-- 
		<div class="img_view_bar_btn_left"><a href="javascript:void(0)"><img src="/static/wap/images/btn_left.png" /></a></div>
		<div class="img_view_bar_btn_right"><a href="javascript:void(0)"><img src="/static/wap/images/btn_right.png" /></a></div>
		 -->
		</div>
		<div class="goods_btn_placeholder_bar"></div>
		<div class="goods_btn_bar">
			<!-- 非供应商的商品 -->
			<a class="man_button"
				href="<?=Url::toRoute(['/sale/vip-center/index'])?>"><img
				src="images/sale/icon_man.png"></a> <a class="cart_button"
				href="<?=Url::toRoute(['/sale/vip-cart/index'])?>"><img
				src="images/sale/icon_cart.png"></a> <input type="hidden"
				value="<?=$model['id']?>" name="detailList[0][product_id]">
				
				<input type="hidden"
				value="1" name="detailList[0][checked]">
				<a
				class="buy_button1 buy" id="btn_add_to_cart" href="javascript:void(0)" style="width: 30%">添加到购物车</a> <a
				class="buy_button1 buy" id="btn_buy" href="javascript:void(0)" style="width: 30%">立即购买</a>
		</div>

	</div>
</form>

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

	$(".items img").width($(document.body).width());	
	$('#photo_slideBox').slideBox({hideClickBar:false});
	
	$('#link_reduce_quantity').click(function(){
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

	$('#link_add_quantity').click(function(){
		var buy_quantity = $('#buy_quantity').val();
		var quantity = 1;
		if(/^[0-9]*[1-9][0-9]*$/.test(buy_quantity) == false){
			quantity = 1;
		}else{
			quantity = parseInt(buy_quantity) +1; 
		}
		//console.debug(quantity);
		$('#buy_quantity').val(quantity);
	});

	$('#buy_quantity').change(function(){
		var buy_quantity = $('#buy_quantity').val();
		var quantity = buy_quantity;
		if(/^[0-9]*[1-9][0-9]*$/.test(buy_quantity) == false){
			quantity = 1;
		}
		$('#buy_quantity').val(quantity);
// 		$('#buy_quantity').val(quantity);
	});
		
	$('#btn_buy').click(function(){
		var buy_quantity = $('#buy_quantity').val();
		$.blockUI({ message: '<span style="text-align:center"><img src="/images/sale/img_loading.png" /><div>处理中,请稍等...</div></span>' });
		$.ajax({     
		    url:'<?=Url::toRoute(['/api/vip-cart/create'])?>',     
		    type:'post',  
		    dataType:'json', 
		    data:{
		    	'ShoppingCart[product_id]':<?php echo $model['id']?>,
		    	'ShoppingCart[quantity]':buy_quantity,
		    	'ShoppingCart[price]':<?php echo $model['price']?>,
		    	'_csrf':'<?= @Yii::$app->request->csrfToken ?>'
		    	},     
		    	
		    async :true, 
		    error:function(){     
		       //alert('获取数据失败');    
		    	$.unblockUI();  
		    },     
		    success:function(data){ 
			    console.debug(data);
			    if(data.status==1){
			    	//$('#btn_collect').prop('src','images/sale/collect-undo.png');
			    	//alert('添加购物车成功'); 
			    	//window.location.href="<?=Url::toRoute(['/sale/vip-order/confirm','product_id'=>$model['id']])?>&quantity="+buy_quantity;
			    	$("#product_detail_form").submit();
			    }else{
				    alert('请先登录');
				    window.location.href='<?=Url::toRoute(['/sale/vip-login/index'])?>';
			    }
			    $.unblockUI();
		    }  
		}); 
		
		//window.location.href="<?=Url::toRoute(['/sale/vip-order/confirm','product_id'=>$model['id']])?>&quantity="+buy_quantity;
	});


	$('#btn_add_to_cart').click(function(){
		var buy_quantity = $('#buy_quantity').val();
		$.blockUI({ message: '<span style="text-align:center"><img src="/images/sale/img_loading.png" /><div>处理中,请稍等...</div></span>' });
		$.ajax({     
		    url:'<?=Url::toRoute(['/api/vip-cart/create'])?>',     
		    type:'post',  
		    dataType:'json', 
		    data:{
		    	'ShoppingCart[product_id]':<?php echo $model['id']?>,
		    	'ShoppingCart[quantity]':buy_quantity,
		    	'ShoppingCart[price]':<?php echo $model['price']?>,
		    	'_csrf':'<?= @Yii::$app->request->csrfToken ?>'
		    	},     
		    	
		    async :true, 
		    error:function(){     
		       //alert('获取数据失败');    
		    	$.unblockUI();  
		    },     
		    success:function(data){ 
			    console.debug(data);
			    if(data.status==1){
			    	//$('#btn_collect').prop('src','images/sale/collect-undo.png');
			    	alert('添加购物车成功'); 
			    }else{
				    alert('请先登录');
				    window.location.href='<?=Url::toRoute(['/sale/vip-login/index'])?>';
			    }
			    $.unblockUI();
		    }  
		}); 
		
		//window.location.href="<?=Url::toRoute(['/sale/vip-order/confirm','product_id'=>$model['id']])?>&quantity="+buy_quantity;
	});

	$('#btn_collect').click(function(){
		var src = $('#btn_collect').prop('src');
		//console.debug(src);
		if(src.indexOf('collect.png')>=0){
			collect_add();	
		}else{
			collect_del();	
		}
	});


	function collect_add(){
		$.ajax({     
		    url:'<?=Url::toRoute(['/sale/vip-collect/add'])?>',     
		    type:'post',  
		    dataType:'json', 
		    data:{
		    	product_id:<?php echo $model['id']?>,
		    	'_csrf':'<?= @Yii::$app->request->csrfToken ?>'
		    	},     
		    	
		    async :true, 
		    error:function(){     
		       alert('获取数据失败');    
		    },     
		    success:function(data){ 
			    if(data.status==1){
			    	$('#btn_collect').prop('src','images/sale/collect-undo.png');
			    	alert('收藏成功'); 
			    }
		    	
		    }  
		}); 
	}

	function collect_del(){
		$.ajax({     
		    url:'<?=Url::toRoute(['/sale/vip-collect/del'])?>',     
		    type:'post',  
		    dataType:'json', 
		    data:{
		    	product_id:<?php echo $model['id']?>,
		    	'_csrf':'<?= @Yii::$app->request->csrfToken ?>'
		    	},     
		    async :true, 
		    error:function(){     
		       alert('获取数据失败');    
		    },     
		    success:function(data){ 
			    if(data.status==1){
			    	$('#btn_collect').prop('src','images/sale/collect.png');
			    	alert('取消收藏成功'); 
			    }
		    	
		    }  
		}); 
	}

	
		
	
});


</script>


