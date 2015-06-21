<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\basic\DeliveryType;

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
            <td class="td-column" style="width:200px;">配送唯一编号</td>
            <td class="">
                <?= Html::activeInput('text', $model, 'code', ['class' => 'form-input required']) ?>
            </td>
        </tr>
        <tr>
            <td class="td-column">快递公司</td>
            <td class=""><?= Html::activeInput('text', $model, 'name', ['maxlength' => 60, 'class' => 'form-input required']) ?></td>
        </tr>        
        <tr>
            <td class="td-column">状态</td>
            <td class="">
                <?= Html::activeDropDownList($model, 'status', DeliveryType::StatusType(), ['class' => 'form-select']) ?>
            </td>
        </tr>
        <tr>
            <td class="td-column">打印模板</td>
            <td class=""><?= Html::activeTextarea($model, 'print_tpl', ['class' => 'form-input form-textarea']) ?></td>
        </tr>
        <tr>
            <td class="td-column">备注</td>
            <td class=""><?= Html::activeTextarea($model, 'description', ['class' => 'form-input form-textarea']) ?></td>
        </tr>
    </table>
    <p class="center">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn_large' : 'btn btn_large btn-primary ']) ?>
    </p>

    <?php ActiveForm::end(); ?>

</div>
