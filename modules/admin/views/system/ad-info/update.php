<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\system\AdInfo */

$this->title = 'Update Ad Info: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ad Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ad-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
