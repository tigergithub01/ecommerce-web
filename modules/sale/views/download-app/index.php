<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "APP下载";
$this->registerCssFile('css/sale/bootstrap.css');
?>

<div class="download-app-form" style="margin: 10px;">
	<?=Html::a('安卓下载',['/sale/download-app/index'],['class' => 'btn btn-primary','style'=>'width:100%;margin-top:10px;'])?>
	<?=Html::a('苹果下载',['/sale/download-app/index'],['class' => 'btn btn-primary','style'=>'width:100%;margin-top:10px;'])?>
	
	
</div>

<script type="text/javascript">
$(function(){
	$("#btn_download_android").click(function(){
		//console.debug('btn_get_verfityCode clicked');	
		//alert('xx');
	});

	$("#btn_download_ios").click(function(){
		//console.debug('btn_get_verfityCode clicked');	
		//alert('xx');
		//<a href="itms-services://?action=download-manifest&amp;url=https://www.xxx.com/zff.plist">苹果下载</a>
	});
});
</script>
