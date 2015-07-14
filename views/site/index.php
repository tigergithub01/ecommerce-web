<?php
use yii\helpers\Html;
use yii\helpers\Url;


$this->registerJsFile ( "js/jquery/jquery-1.8.2.min.js", [ 
		'position' => \yii\web\View::POS_HEAD 
] );
?>



<script type="text/javascript">
$(function(){
	window.location.href='<?=Url::toRoute(['/sale/default/index'])?>';	
});
</script>


