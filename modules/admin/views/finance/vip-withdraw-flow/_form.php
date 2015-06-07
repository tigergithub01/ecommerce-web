<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\finance\VipWithdrawFlow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vip-withdraw-flow-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sheet_type_id')->textInput() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'apply_date')->textInput() ?>

    <?= $form->field($model, 'vip_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'settled_amt')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'settled_date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
