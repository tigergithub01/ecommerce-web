<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "个人中心";
$this->registerCssFile('css/sale/userCenter.css');
$this->registerCssFile('css/sale/common.css');
?>


<div class="vip-center-form" style="margin: 10px;">
	<header data-role="header">
			<div class="uc-user">
            
            <a href="#" class="box">
                <div class="">
                        <p></p>
                        <p>已绑定：137****6621</p>
                        <span class="right-txt"></span>
                </div>
            </a>
        </div>
			    </header>
    <section data-role="body" class="section-body on" style="min-height: 402px;">
        <!--通知-->
        <div class="uc-notification">
            <ul class="box">
                <li>
                    <a href="<?=Url::toRoute(['/sale/vip-order/index','status' => '1'])?>"><i class="icon-pay" data-tip="0"></i>待支付</a>
                </li>
                <li>
                    <a href="<?=Url::toRoute(['/sale/vip-order/index','status' => '2'])?>"><i class="icon-deliver" data-tip="0"></i>待发货</a>
                </li>
                <li>
                    <a href="<?=Url::toRoute(['/sale/vip-order/index','status' => '3'])?>"><i class="icon-receipt" data-tip="0"></i>待收货</a>
                </li>
                <li>
                    <a href="<?=Url::toRoute(['/sale/vip-order/index','status' => '4'])?>"><i class="icon-comment" data-tip="0"></i>待评价</a>
                </li>
                <li>
                    <a href="<?=Url::toRoute(['/sale/vip-order/index','status' => '5'])?>"><i class="icon-refund" data-tip="0"></i>已完成</a>
                </li>
            </ul>
        </div>
        <!-- 
        <!--订单和收藏-->
        <div>
            <ul class="list">
                <li><a href="<?=Url::toRoute(['/sale/vip-order/index'])?>"><i class="icon-order"></i>全部订单</a></li>
                
                <li><a href="<?=Url::toRoute(['/sale/vip-login/logout'])?>"><i class="icon-fav-shop"></i>退出登录</a></li>
                <!-- 
                <li><a href="http://ysk.xmgapay.com/wap.php/user/favorites/type/goods.html"><i class="icon-fav"></i>收藏商品</a></li>
                
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


