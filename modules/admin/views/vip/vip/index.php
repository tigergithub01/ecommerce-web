<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vips';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vip-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Vip', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'vip_no',
            'name',
            'id_card',
            'last_login_date',
            // 'password',
            // 'parent_id',
            // 'email:email',
            // 'email_verify_flag:email',
            // 'status',
            // 'register_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
