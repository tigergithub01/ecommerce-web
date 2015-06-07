<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\product\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'stock_quantity')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'safety_quantity')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'create_user_id')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'update_user_id')->textInput() ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <?= $form->field($model, 'can_return_flag')->textInput() ?>

    <?= $form->field($model, 'return_days')->textInput() ?>

    <?= $form->field($model, 'return_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'regular_type_id')->textInput() ?>

    <?= $form->field($model, 'deduct_price')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'special_deduct_flag')->textInput() ?>

    <?= $form->field($model, 'deduct_level1')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'deduct_level2')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'deduct_level3')->textInput(['maxlength' => 14]) ?>

    <?= $form->field($model, 'deduct_level4')->textInput(['maxlength' => 14]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
