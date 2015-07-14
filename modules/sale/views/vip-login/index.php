<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = "登录";

$this->registerCssFile('css/sale/bootstrap.css');
?>


<div class="vip-login-form wrapper" style="margin: 10px;">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vip_no')->textInput(['type'=>'number','maxlength' => 11,'placeholder'=>'请输入手机号'])?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 16,'placeholder'=>'请输入密码'])?>

    
    <div class="form-group">
        <?= Html::submitButton('登录', ['class' => 'btn btn-primary','style'=>'width:100%;height:60px;']) ?>
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
	
</script>
