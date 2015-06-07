<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\order\SoSheet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="so-sheet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'sheet_type_id')->textInput() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'vip_id')->textInput() ?>

    <?= $form->field($model, 'order_amt')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'order_quantity')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'deliver_fee')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'settle_flag')->textInput() ?>

    <?= $form->field($model, 'order_date')->textInput() ?>

    <?= $form->field($model, 'delivery_date')->textInput() ?>

    <?= $form->field($model, 'delivery_type')->textInput() ?>

    <?= $form->field($model, 'delivery_no')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'pay_type_id')->textInput() ?>

    <?= $form->field($model, 'pay_amt')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'pay_date')->textInput() ?>

    <?= $form->field($model, 'return_amt')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'return_date')->textInput() ?>

    <?= $form->field($model, 'memo')->textInput(['maxlength' => 400]) ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => 300]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
