<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'name',
            'type_id',
            'price',
            // 'description:ntext',
            // 'status',
            // 'stock_quantity',
            // 'safety_quantity',
            // 'create_user_id',
            // 'create_date',
            // 'update_user_id',
            // 'update_date',
            // 'can_return_flag',
            // 'return_days',
            // 'return_desc:ntext',
            // 'regular_type_id',
            // 'deduct_price',
            // 'special_deduct_flag',
            // 'deduct_level1',
            // 'deduct_level2',
            // 'deduct_level3',
            // 'deduct_level4',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
