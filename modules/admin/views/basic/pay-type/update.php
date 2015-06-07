<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\basic\PayType */

$this->title = 'Update Pay Type: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pay Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pay-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
