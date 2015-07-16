<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;



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

    
    <table class="table_edit">
        <tr>
            <td class="td-column" style="width:200px;">一级分润比例</td>
            <td class="">
                <?= Html::activeInput('text', $model, 'deduct_level1', ['class' => 'form-input required']) ?>%
            </td>
        </tr>
        <tr>
            <td class="td-column" style="width:200px;">二级分润比例</td>
            <td class="">
                <?= Html::activeInput('text', $model, 'deduct_level2', ['class' => 'form-input required']) ?>%
            </td>
        </tr>
        <tr>
            <td class="td-column" style="width:200px;">三级分润比例</td>
            <td class="">
                <?= Html::activeInput('text', $model, 'deduct_level3', ['class' => 'form-input required']) ?>%
            </td>
        </tr>
        <tr>
            <td class="td-column" style="width:200px;">四级分润比例</td>
            <td class="">
                <?= Html::activeInput('text', $model, 'deduct_level4', ['class' => 'form-input required']) ?>%
            </td>
        </tr>
        <tr>
            <td class="td-column"></td>
            <td ><strong class="red">*四级分润加起来不能超过100%</strong></td>
        </tr>
       
     
    </table>
    <p class="center">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn_large' : 'btn btn_large btn-primary ']) ?>
    </p>

    <?php ActiveForm::end(); ?>

</div>
