<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "APP下载";
$this->registerCssFile('css/sale/bootstrap.css');
?>

<div class="download-app-form wrapper" style="margin: 10px;">
	<?php /*Html::a('安卓下载',['/sale/download-app/index'],['class' => 'btn btn-primary','style'=>'width:100%;margin-top:10px;height:60px;'])*/?>
	<?php /*Html::a('苹果下载',['/sale/download-app/index'],['class' => 'btn btn-primary','style'=>'width:100%;margin-top:10px;height:60px;'])*/?>
	
	<?php echo Html::button('安卓下载',['class' => 'btn btn-primary','id'=>'btn_download_android','style'=>'width:100%;margin-top:10px;height:60px;'])?>
	<?php echo Html::button('苹果下载',['class' => 'btn btn-primary','id'=>'btn_download_ios','style'=>'width:100%;margin-top:10px;height:60px;'])?>
	
	
</div>
<div class="weixin_download_notify"
	style="z-index: 100; position:absolute; ; top: 0; left: 0; display: none;">
	<img alt="" src="/images/sale/weixin_download_notify.png" width="100%" height="100%">
</div>

<script type="text/javascript">
$(function(){
	$("#btn_download_android").click(function(){
		//console.debug('btn_get_verfityCode clicked');	
		if(isWeiXin()){
			$(".weixin_download_notify").show();
			return false;
		}
		window.location.href='<?=Url::toRoute(['/sale/download-app/android'])?>';
	});

	$("#btn_download_ios").click(function(){
		//console.debug('btn_get_verfityCode clicked');	
		//alert('xx');
		//<a href="itms-services://?action=download-manifest&amp;url=https://www.xxx.com/zff.plist">苹果下载</a>
		alert('正在开发中，请耐心等待。')
		//window.location.href='<?=Url::toRoute(['/sale/download-app/ios'])?>';
		
	});
	
	$(".weixin_download_notify").css({'width':$(window).width(),'height':$(window).height()});

	$(".weixin_download_notify").click(function(){
		$(this).hide();
	});

	function isWeiXin(){
		var ua = window.navigator.userAgent.toLowerCase();
		if(ua.match(/MicroMessenger/i) == 'micromessenger'){
			return true;
		}else{
			return false;
		}
	} 
	
});
</script>
