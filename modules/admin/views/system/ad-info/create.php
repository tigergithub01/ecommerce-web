<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\system\AdInfo */

$this->title = 'Create Ad Info';
$this->params['breadcrumbs'][] = ['label' => 'Ad Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
