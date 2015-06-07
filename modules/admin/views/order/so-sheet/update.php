<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\order\SoSheet */

$this->title = 'Update So Sheet: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'So Sheets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="so-sheet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
