<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
// $this->title = '蝶富平台';
$this->title = "平台";
$this->registerJsFile ( "js/jquery/jquery-1.8.2.min.js", [ 
		'position' => \yii\web\View::POS_HEAD 
] );
?>

<div class="platform-index-form" style='height: 300px; width: 300px;'>
	<img class="container_bg" src="images/sale/bg.png" 
		style="height: 300px; width: 300px; position: absolute; z-index: -10;margin: 0px;">
		
	<div style="width: 100%; background: #ccc">
		<?php echo Html::button('手机快速注册',['id'=>'btn_quick_register','class' => 'btn btn-primary','style'=>'width:100%;height:60px;'])?>
	</div>

</div>

<!-- 
		<a id="btn" class="btn" href="<?= Url::toRoute(['/sale/vip-register/index'])?>"><img src="/images/sale/quick_register.png"></a>
		 -->
<?php //echo Html::a('Update', ['/sale/vip-login/index'], ['class' => 'btn btn-primary','style'=>'top: 2685px;']) ?>


<script type="text/javascript">
$(function(){

	resizeContainer();

	$(window).resize(function(){
		resizeContainer();
	});
	
	$("#btn_quick_register").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/vip-register/index'])?>';	
	});	

	
});


function resizeContainer(){
	$(".platform-index-form").css({'width':$(window).width(),'height':$(window).height()});
	$(".container_bg").css({'width':$(window).width(),'height':$(window).height()});
}

</script>


