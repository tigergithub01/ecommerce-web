<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\system\SheetType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sheet-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'prefix')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'date_format')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'sep')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'seq_length')->textInput() ?>

    <?= $form->field($model, 'cur_seq')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
