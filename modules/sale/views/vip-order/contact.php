<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "收货详情";
$this->registerCssFile ('css/sale/header.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/payment.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile ('css/sale/common.css',['position' => \yii\web\View::POS_HEAD] );
$this->registerCssFile('css/sale/bootstrap.css');
?>


<div class="vip-order-detail-form" style="margin: 10px;">
	<?php $form = ActiveForm::begin(['options' => ['class' => 'form-vertical'],]); ?>
	
    <?= $form->field($model, 'name')->textInput(['maxlength' => 10,'placeholder'=>'请输入姓名'])?>
    
    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 10,'placeholder'=>'请输入手机号码'])?>
    
    <?= $form->field($model, 'province_id')->dropDownList($provinces,
                                              ['prompt'=>'--请选择收货省份--','style'=>'width:100%']) ?>
                                              
    <?= $form->field($model, 'city_id')->dropDownList($cities,
                                              ['prompt'=>'--请选择收货城市--','style'=>'width:100%']) ?>   
                                              
    <?= $form->field($model, 'district_id')->dropDownList($districts,
                                              ['prompt'=>'--请选择所属片区--','style'=>'width:100%']) ?>                                                                                   
    
	<?= $form->field($model, 'detail_address')->textInput(['maxlength' => 200,'placeholder'=>'请输入详细地址'])?>
    
    <div class="form-group">
        <?php echo Html::submitButton('下一步', ['class' => 'btn btn-primary','style'=>'width:100%;height:60px;'])?>
        <?php /*echo Html::button('下一步',['class' => 'btn btn-primary','id'=>'btn_submit_contact','style'=>'width:100%;margin-top:10px;height:60px;'])*/?>
    </div>

    <?php ActiveForm::end(); ?>
    
	

</div>

<style type="text/css">
<!--
.control-label {
	display: none;
}
-->
</style>



<script type="text/javascript">
$(function(){
	$("#btn_submit_contact").click(function(){
		window.location.href='<?=Url::toRoute(['/sale/vip-order/confirm'])?>';	
	});		
});


</script>


