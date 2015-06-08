<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
//$this->title = '蝶富平台';
$this->title="test";
$this->css=null;
$this->cssFiles=null;
//var_dump($this->assetBundles);
//$this->registerCss($css);

?>
<style type="text/css">
body{
	padding: 0px;
	margin: 0px;
}
.container{
	display: block;
	width: 100%;
	margin: 0px;
	height: auto;
	position: relative;
}
.container_bg{
	position: absolute;
	top: 0px;
	left: 0px;
	width: 100%;
	z-index: 1;
}
.btn{
	position: absolute;
	left: 20%;
	width: 60%;
	z-index: 2;
}
.btn img{
	width: 100%;
	border: none;
	margin: 0px;
	z-index: 3;
}
</style>


<div class="container">
		
		<a style="top: 2685px;" id="btn" class="btn" href="<?= Url::toRoute(['/sale/vip-login/index'])?>"><img src="images/quick_register.png"></a>
		
		<?php //echo Html::a('Update', ['/sale/vip-login/index'], ['class' => 'btn btn-primary','style'=>'top: 2685px;']) ?>
		
		<!-- 
		<img class="container_bg" src="images/bg.png">
		 -->
		 
	</div>

<script type="text/javascript">
window.onload = function(){
	document.getElementById("btn").style.top = parseInt(document.body.scrollHeight - document.getElementById("btn").clientHeight - 6) + "px";
};
</script>


