<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\finance\VipWithdrawFlow */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vip Withdraw Flows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vip-withdraw-flow-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sheet_type_id',
            'code',
            'apply_date',
            'vip_id',
            'amount',
            'settled_amt',
            'settled_date',
            'status',
        ],
    ]) ?>

</div>
