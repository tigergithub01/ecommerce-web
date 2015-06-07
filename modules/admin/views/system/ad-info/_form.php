<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\system\AdInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image_url')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'sequence_id')->textInput() ?>

    <?= $form->field($model, 'redirect_url')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
