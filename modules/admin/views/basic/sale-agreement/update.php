<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\basic\DeliveryType */

$this->title = '销售协议' . ' ' ;
$this->params['breadcrumbs'][] = ['label' => '销售协议', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="delivery-type-update">

    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['index'])?>' class='button_link'><i class='icon-angle-left icon-large'></i>返回</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
