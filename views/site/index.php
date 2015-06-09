<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
//$this->title = '蝶富平台';
$this->title="平台";
$this->registerJsFile("js/jquery/jquery-1.8.2.min.js",['position' => \yii\web\View::POS_HEAD]);
?>

<div class="platform-index-form">
	<?php echo Html::button('手机快速注册',['id'=>'btn_quick_register','class' => 'btn btn-primary','style'=>'width:100%;margin-top:5px;margin-left:2px;height:60px;'])?>
	<img class="container_bg" src="images/sale/bg.png" style="width:100%">
</div>
		
		<!-- 
		<a id="btn" class="btn" href="<?= Url::toRoute(['/sale/vip-register/index'])?>"><img src="/images/sale/quick_register.png"></a>
		 -->
		<?php //echo Html::a('Update', ['/sale/vip-login/index'], ['class' => 'btn btn-primary','style'=>'top: 2685px;']) ?>
		

<script type="text/javascript">
$(function(){
	$("#btn_quick_register").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/vip-register/index'])?>';	
	});	
});

</script>


