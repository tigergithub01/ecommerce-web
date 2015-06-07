<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\finance\VipWithdrawFlow */

$this->title = 'Update Vip Withdraw Flow: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vip Withdraw Flows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vip-withdraw-flow-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
