<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\system\AdInfo */
/* @var $form yii\widgets\ActiveForm */
?>

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
            <td class="td-column" style="width:150px;">图片地址</td>
            <td>
                <?php if(!$model->isNewRecord){ ?>
                <div style="width:220px;overflow:hidden;">
                    <img src="<?=Yii::getAlias('@web/upload/ad/').$model->image_url?>" style="max-width: 220px;">         
                </div>
                <?php } ?>
                <p><?=Html::activeFileInput($model, 'file',['class'=>''])?><span class="red">（文件不能超过1M,只能是jpg,png格式图片）</span></p>                
            </td>
        </tr>       
        <tr>
            <td class="td-column">排序数字</td>
            <td><?=Html::activeTextInput($model, 'sequence_id',['class'=>'form-input required','maxlength' => 600])?></td>
        </tr>
        <tr>
            <td class="td-column">跳转URL</td>
            <td><?=Html::activeTextInput($model, 'redirect_url',['class'=>'form-input','maxlength' => 600])?></td>
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
