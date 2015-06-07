<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\system\SheetType */

$this->title = 'Create Sheet Type';
$this->params['breadcrumbs'][] = ['label' => 'Sheet Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sheet-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
