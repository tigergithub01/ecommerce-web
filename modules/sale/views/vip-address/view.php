<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\vip\VipAddress */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vip Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile ( 'css/sale/bootstrap.css' );
?>
<div class="vip-address-view">

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
            'vip_id',
            'name',
            'phone_number',
            'province_id',
            'city_id',
            'district_id',
            'detail_address',
            'default_flag',
        ],
    ]) ?>

</div>
