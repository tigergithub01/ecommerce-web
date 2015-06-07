<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\order\SoSheet */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'So Sheets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="so-sheet-view">

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
            'vip_id',
            'order_amt',
            'order_quantity',
            'deliver_fee',
            'status',
            'settle_flag',
            'order_date',
            'delivery_date',
            'delivery_type',
            'delivery_no',
            'pay_type_id',
            'pay_amt',
            'pay_date',
            'return_amt',
            'return_date',
            'memo',
            'message',
        ],
    ]) ?>

</div>
