<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\basic\Parameter;
$scopeTypeArray=Parameter::find()->select('id,pa_val')->where(['type_id'=>7])->asArray()->all();
$scopeTypeList=ArrayHelper::map($scopeTypeArray, 'id', 'pa_val');
/* @var $this yii\web\View */
/* @var $model app\models\system\AdInfo */
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
<div class="ad-info-form">
    
    <?php
    if ($model->errors) {
        echo Html::errorSummary($model, ['header' => '输入有误，请检查：', 'class' => 'error-summary']);
    }
    ?>
    
    <?php $form = ActiveForm::begin([
        'id'=>'form1',
        'options'=>[
            'enctype' => 'multipart/form-data',
            ],
        
    ]); ?>
    <table class="table_edit">
        <tr>
            <td class="td-column">发布范围</td>
            <td><?=Html::activeDropDownList($model, 'scope_type',$scopeTypeList,['class'=>'form-input','maxlength' => 100])?></td>
        </tr>
        <tr>
            <td class="td-column">标题</td>
            <td><?=Html::activeTextInput($model, 'title',['class'=>'form-input required','maxlength' => 100])?></td>
        </tr>
        <tr>
            <td class="td-column">内容</td>
            <td><?=Html::activeTextarea($model, 'content',['class'=>'form-input form-textarea'])?></td>
        </tr>
        <tr>
            <td class="td-column">&nbsp;</td>
            <td>
                <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'button_link' : 'btn btn-primary ']) ?>
            </td>
        </tr>
    </table>
    
    <div class="form-group">
        
    </div>

    <?php ActiveForm::end(); ?>    

</div>
