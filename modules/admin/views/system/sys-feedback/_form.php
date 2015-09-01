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
