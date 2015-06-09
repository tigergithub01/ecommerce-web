<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "APP下载";
$this->registerCssFile('css/sale/bootstrap.css');
?>

<div class="download-app-form" style="margin: 10px;">
	<?php /*Html::a('安卓下载',['/sale/download-app/index'],['class' => 'btn btn-primary','style'=>'width:100%;margin-top:10px;height:60px;'])*/?>
	<?php /*Html::a('苹果下载',['/sale/download-app/index'],['class' => 'btn btn-primary','style'=>'width:100%;margin-top:10px;height:60px;'])*/?>
	
	<?php echo Html::button('安卓下载',['class' => 'btn btn-primary','id'=>'btn_download_android','style'=>'width:100%;margin-top:10px;height:60px;'])?>
	<?php echo Html::button('苹果下载',['class' => 'btn btn-primary','id'=>'btn_download_ios','style'=>'width:100%;margin-top:10px;height:60px;'])?>
	
</div>

<script type="text/javascript">
$(function(){
	$("#btn_download_android").click(function(){
		//console.debug('btn_get_verfityCode clicked');	
		//alert('xx');
		window.location.href='<?=Url::toRoute(['/sale/download-app/android'])?>';	
	});

	$("#btn_download_ios").click(function(){
		//console.debug('btn_get_verfityCode clicked');	
		//alert('xx');
		//<a href="itms-services://?action=download-manifest&amp;url=https://www.xxx.com/zff.plist">苹果下载</a>
	});
});
</script>
