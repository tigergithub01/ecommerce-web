<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\product\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

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
            'code',
            'name',
            'type_id',
            'price',
            'description:ntext',
            'status',
            'stock_quantity',
            'safety_quantity',
            'create_user_id',
            'create_date',
            'update_user_id',
            'update_date',
            'can_return_flag',
            'return_days',
            'return_desc:ntext',
            'regular_type_id',
            'deduct_price',
            'special_deduct_flag',
            'deduct_level1',
            'deduct_level2',
            'deduct_level3',
            'deduct_level4',
        ],
    ]) ?>

</div>
