<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'So Sheets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="so-sheet-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create So Sheet', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sheet_type_id',
            'code',
            'vip_id',
            'order_amt',
            // 'order_quantity',
            // 'deliver_fee',
            // 'status',
            // 'settle_flag',
            // 'order_date',
            // 'delivery_date',
            // 'delivery_type',
            // 'delivery_no',
            // 'pay_type_id',
            // 'pay_amt',
            // 'pay_date',
            // 'return_amt',
            // 'return_date',
            // 'memo',
            // 'message',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
