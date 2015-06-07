<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\finance\VipWithdrawFlow */

$this->title = 'Create Vip Withdraw Flow';
$this->params['breadcrumbs'][] = ['label' => 'Vip Withdraw Flows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vip-withdraw-flow-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
