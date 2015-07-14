<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "个人中心";
$this->registerCssFile ( 'css/sale/userCenter.css' );
$this->registerCssFile ( 'css/sale/header.css' );
$this->params['show_nav']=1;
$this->params['hidden_header']=0;
?>
<style type="text/css">

</style>

<div class="vip-center-form wrapper">

	<header>
		<div class="uc-user">
			<a href="<?=Url::toRoute(['/sale/vip-center/view'])?>" class="box" style="text-align: center;">
				<div class="" >
					<p></p>
					<p>已绑定：<?php echo $_SESSION['current_vip']['vip_no']?></p>
					
					<span class="right-txt"></span>
					 
					 
				</div>
			</a>
		</div>
	</header>
	 
	<section data-role="body" class="section-body on"
		style="min-height: 402px;">
		<!--通知-->
		<div class="uc-notification">
			<ul class="box">
				<?php foreach ($orderCountList as $value) {
					/*if($value['id']!=3007 && $value['id']!=3008){*/?>
					<li>
					<a href="<?php echo Url::toRoute(['/sale/vip-order/index','status' => $value['id']]) ?>"><i
						class="icon-pay"></i><?php echo $value['pa_val']?></a><font color="red"><?php echo ($value['count']==0)?'':$value['count'] ?></font> </li>
				<?php /*}*/}?>
			</ul>
			
			<!-- 
			<ul class="box">
				<li><a
					href="<?=Url::toRoute(['/sale/vip-order/index','status' => '1'])?>"><i
						class="icon-pay" data-tip="1"></i>待支付</a></li>
				<li><a
					href="<?=Url::toRoute(['/sale/vip-order/index','status' => '2'])?>"><i
						class="icon-deliver" data-tip="0"></i>待发货</a></li>
				<li><a
					href="<?=Url::toRoute(['/sale/vip-order/index','status' => '3'])?>"><i
						class="icon-receipt" data-tip="0"></i>待收货</a></li>
				<li><a
					href="<?=Url::toRoute(['/sale/vip-order/index','status' => '4'])?>"><i
						class="icon-comment" data-tip="0"></i>待评价</a></li>
				<li><a
					href="<?=Url::toRoute(['/sale/vip-order/index','status' => '5'])?>"><i
						class="icon-refund" data-tip="0"></i>已完成</a></li>
			</ul>
			 -->
		</div>
		<!-- 
        <!--订单和收藏-->
		<div>
			<ul class="list">
				<li><a href="<?=Url::toRoute(['/sale/vip-order/index'])?>"><i
						class="icon-order"></i>全部订单</a></li>
				<li><a href="<?=Url::toRoute(['/sale/vip-cart/index'])?>"><i
						class="icon-order"></i>购物车</a></li>
				<li><a href="<?=Url::toRoute(['/sale/vip-address/index'])?>"><i
						class="icon-order"></i>收货地址</a></li>	
				<li><a href="<?=Url::toRoute(['/sale/vip-center/view'])?>"><i
						class="icon-order"></i>我的资料</a></li>			
						<!-- 
				<li><a href="<?=Url::toRoute(['/sale/vip-collect/index'])?>"><i
						class="icon-fav"></i>我的收藏</a></li>
						 -->
				<!-- 
				<li><a href="<?=Url::toRoute(['/sale/vip-login/logout'])?>"><i class="icon-fav-shop"></i>退出登录</a></li>
				 -->		
			</ul>
		</div>
		<!--管理地址-->
		<!-- 
        <div>
            <ul class="list">
                <li><a href="http://ysk.xmgapay.com/wap.php/user/address/mobile/13724346621.html"><i class="icon-address"></i>管理收货地址</a></li>
            </ul>
        </div>
         -->
	</section>

</div>





<script type="text/javascript">
$(function(){
		
});


</script>


