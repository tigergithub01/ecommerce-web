<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\order\SoSheet */

$this->title = 'Create So Sheet';
$this->params['breadcrumbs'][] = ['label' => 'So Sheets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="so-sheet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
