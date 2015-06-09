<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "订单列表";
$this->registerCssFile ('css/sale/common.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/orderlb.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/header.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/order.css',['position' => \yii\web\View::POS_HEAD] );
?>


<div class="vip-order-form" style="margin: 10px;">
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
	<section id="0" style="display: block;">
		<div class="order_item_bar">
			<div class="info_block">
				<div class="img">
					<img
						src="">
				</div>
				<div class="info_title">
					<div class="name">丽瓦丽干红</div>
					<div class="standard">
						规格：<span>×2</span>
					</div>
					<div class="price1">￥368.00</div>

				</div>

			</div>
			<hr class="gray_solid" style="margin-left: 12px;">
			<div class="statistic_block">
				<span>共1件 </span> <span>运费：0.00 </span> <span>实付：</span> <span
					class="price">￥736.00</span>
			</div>
			<hr class="gray_solid" style="margin-left: 12px;">

		</div>
		<div class="detail_btn_bar">
			<a class="default danger" href="javascript:void(0)"
				onclick="confirm_url('确定要取消此订单吗？','')">取消订单</a>
			<a class="default primary"
				href="">付款</a>
		</div>
	</section>
	<section id="1" style="display: none;">
		<div class="nav-content toggle-content">
			<ul class="nav-item on empty" data-type="deliver"
				data-empty="您还没有相关的订单~"></ul>
		</div>
	</section>
	<section id="2" style="display: none;">
		<div class="nav-content toggle-content">
			<ul class="nav-item on empty" data-type="deliver"
				data-empty="您还没有相关的订单~"></ul>
		</div>
	</section>
	<section id="3" style="display: none;">
		<div class="nav-content toggle-content">
			<ul class="nav-item on empty" data-type="deliver"
				data-empty="您还没有相关的订单~"></ul>
		</div>
	</section>
	<section id="4" style="display: none;">
		<div class="nav-content toggle-content">
			<ul class="nav-item on empty" data-type="deliver"
				data-empty="您还没有相关的订单~"></ul>
		</div>
	</section>
	<footer data-role="footer">
		<script type="text/javascript">
function foot_bg(obj)
{
    var a=document.getElementById("Menu").getElementsByTagName("a");
    for(var i=0;i<a.length;i++)
    {
        a[i].className="";
    }
    obj.className="current";
}
</script>



		<div class="home-menu" id="container">
			<div class="widget_wrap">
				<ul class="box" id="Menu">
					<li><a onclick="foot_bg(this)"
						href="<?=Url::toRoute(['/sale/vip-cart/index'])?>" class=""><span
							data-count="0">&nbsp;</span><label>购物车</label></a></li>
					<li><a onclick="foot_bg(this)"
						href="<?=Url::toRoute(['/sale/vip-center/index'])?>" class=""><span>&nbsp;</span><label>个人中心</label></a>
					</li>
				</ul>
			</div>
		</div>

	</footer>

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


<script>
				  function zxb(a){
				      var tli=document.getElementById("Menu").getElementsByTagName("li");          
					  for(var j=0; j<=4; j++){
					  document.getElementById(j).style.display=j==a?"block":"none";
					                                            
					  }
					  }
					 
				</script>

<script type="text/javascript">
function change_bg(obj)
{
    var a=document.getElementById("Menu").getElementsByTagName("a");
    for(var i=0;i<a.length;i++)
    {
        a[i].className="";
    }
    obj.className="on";
}
</script>

<script type="text/javascript">
$(function(){
	$(".info_block").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/vip-order/view'])?>';	
	});	
});


</script>


