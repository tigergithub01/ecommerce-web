<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\XheditorAsset;

XheditorAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\basic\DeliveryType */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript">
    $(function(){
        $("#form1").validate({
            debug: false,
            onfocusout: function (element) {
                $(element).valid();
            },
            errorElement: 'label',
            errorClass: 'has-error',                     
            messages:{
                
            }
        });
    });
</script>
<div class="delivery-type-form">

    <?php
    if ($model->errors) {
        echo Html::errorSummary($model, ['header' => '输入有误，请检查：', 'class' => 'error-summary']);
    }
    ?>
    
    <?php $form = ActiveForm::begin([
            'id'=>'form1',
    ]);
    ?>

   <?= Html::activeTextarea($model, 'content', ['class' => 'form-input form-textarea required xheditor','style'=>'width:100%;height:300px;']) ?>
         
    <p class="center">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn_large' : 'btn btn_large btn-primary ']) ?>
    </p>

    <?php ActiveForm::end(); ?>

</div>
