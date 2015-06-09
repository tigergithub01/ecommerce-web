<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
//$this->title = '蝶富平台';
$this->title="test";


//var_dump($this->assetBundles);
//$this->registerCss($css);


?>

<div class="vip-login-form" style="margin: 10px;">
<?=Html::a('手机快速注册',['/sale/vip-register/index'],['class' => 'btn btn-primary','style'=>'width:100%;margin-top:10px;'])?>
</div>
<div class="container">
		
		<!-- 
		<a id="btn" class="btn" href="<?= Url::toRoute(['/sale/vip-register/index'])?>"><img src="/images/sale/quick_register.png"></a>
		 -->
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


