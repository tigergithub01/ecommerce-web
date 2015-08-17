<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "产品列表";
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
		<?php if (empty($productList)){?>
			<div style="text-align: center;">
			没有符和条件的产品!
			</div>
		<?php }?>
		<?php foreach ($productList as $product) {?>
		<div class="order_item_bar" style="cursor: pointer;" product_id="<?=$product['id']?>">
			<div class="img"
						style="width: 80px; height: 80px; margin-right: 5px;float: left;">
						<a
							href="javascript:void(0)">
							<img style="width: 70px; height: 70px;"
							src="<?php
			if (isset ( $product->primaryPhoto )) {
				echo Url::toRoute ( [ 
						'/sale/product-photo/view',
						'id' => $product ['primaryPhoto'] ['id'] 
				] );
			}
			?>">
						</a>
					</div>
					<div>
						<div>
							￥<?= round($product['price'],2)?>
						</div>
						<div>
							<?= $product['name']?>
						</div>
						<div>
							
						</div>
					</div>
					
		
		<div class="detail_btn_bar" style="text-align: right: ;">
			<a class="default primary" style="background-color: #cc3433;"
				href="<?=Url::toRoute(['/sale/vip-order-confirm/create','detailList[0][product_id]'=>$product['id'],'detailList[0][quantity]'=>1,'detailList[0][checked]'=>1])?>">立即购买</a>
			
				
		</div>
		
			
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
		var product_id = $(this).attr("product_id");
		window.location.href='<?=Url::toRoute(['/sale/product/view'])?>&id='+product_id;	
	});	
});


</script>


