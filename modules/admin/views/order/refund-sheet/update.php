<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '修改退款单';
$this->params['breadcrumbs'][] = ['label' => '订单', 'url' => ['order/so-sheet/view','id'=>$model->order_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-create">

    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['order/refund-sheet'])?>' class='button_link'><i class='icon-angle-left icon-large'></i>返回退款单列表</a>
            <a href='<?=Url::to(['order/so-sheet/view','id'=>$model->order_id])?>' class='button_link'><i class='icon-angle-left icon-large'></i>返回订单</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>

    <?= $this->render('_form', [
        'model' => $model,        
    ]) ?>

</div>