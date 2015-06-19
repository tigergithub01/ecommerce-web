<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\vip\Vip */

$this->title = '修改会员信息: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '会员列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="vip-update">

    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['view','id'=>$model->id])?>' class='button_link'><i class=' icon-angle-left'></i>返回</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
