<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;


/* @var $this \yii\web\View */
/* @var $content string */

//AppAsset::register($this);

$this->registerJsFile("js/jquery/jquery-1.8.2.min.js",['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('css/sale/headerBar.css');
$this->registerCssFile ('css/sale/common.css' );

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
</head>
<body>
<?php if (isset($this->params['hidden_header']) && $this->params['hidden_header']==1){?>

<?php }else{ ?>
<header style="display: none;">
	<div class="button"><a class="back" href="javascript:window.history.back();"><img src="images/sale/btn_back.png"></a></div>
	<div class="title"><?= Html::encode($this->title) ?></div>
	<?php if (isset($_SESSION['current_vip'])){?>
		<div class="button" style="vertical-align: middle;"><a class="nav" style="text-align: center;" href="<?=Url::toRoute(['/sale/vip-center/index'])?>"><img src="images/sale/icon_p_center_nav.png"></a></div>
	<?php }else{?>
		<div class="button"></div>
	<?php }?>
</header>
<?php }?>

<?php $this->beginBody() ?>
    <?= $content ?>
<?php $this->endBody() ?>

<?php if (isset($this->params['hidden_footer']) && $this->params['hidden_footer']==1){?>

<?php }else{ ?>
<footer style="background: #f8f8f8;color: #848689;font-size: 12px;">
	<hr class="gray_solid">
	<?php if (isset($_SESSION['current_vip'])){?>
	<div class="nav" style="text-align: center;">
		<a href="<?= Url::toRoute(['/sale/vip-center/index'])?>">个人中心</a> | <a href="<?=Url::toRoute(['/sale/vip-cart/index'])?>">购物车</a>
	</div>
	<?php }?>
	<div class="copyright" style="text-align: center;">Copyright @2015深圳智富坊实业有限公司 版权所有</div>
</footer>
<?php }?>
</body>
</html>
<?php $this->endPage() ?>

<script type="text/javascript">
	$(function(){
		$(".wrapper").css({'min-height':($(window).height() - 100 - $(".bottom_bar").height())});
	});
</script>
