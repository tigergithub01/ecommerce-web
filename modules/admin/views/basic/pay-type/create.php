<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\basic\PayType */

$this->title = 'Create Pay Type';
$this->params['breadcrumbs'][] = ['label' => 'Pay Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
