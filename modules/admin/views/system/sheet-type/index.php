<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sheet Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sheet-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sheet Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'name',
            'prefix',
            'date_format',
            // 'sep',
            // 'seq_length',
            // 'cur_seq',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
