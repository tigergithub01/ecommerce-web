<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = "会员详细信息";
$this->registerCssFile('css/sale/bootstrap.css');
$this->registerCssFile('css/sale/headerBar.css');
?>

<style type="text/css">

table.detail-view th{
 width: 150px;
}

</style>

<div class="vip-info-form">
	<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'vip_no',
            'name',
            'id_card',
            'last_login_date',
            //'password',
            //'parent_id',
        	'parent_vip_no',
            //'email:email',
            //'email_verify_flag:email',
            //'status',
            'register_date',
        ],
    ]) ?>
    
<?php echo Html::button('退出登录',['class' => 'btn btn-primary','id'=>'btn_exit','style'=>'width:100%;margin-top:10px;height:60px;'])?>
</div>




<script type="text/javascript">
$(function(){
	$("#btn_exit").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/vip-login/logout'])?>';	
	});	
});


</script>


