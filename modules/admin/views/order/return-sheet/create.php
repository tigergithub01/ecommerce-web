<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '填写退货单';
$this->params['breadcrumbs'][] = ['label' => '订单', 'url' => ['order/so-sheet/view','id'=>$outStockSheetModel->order_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-create">

    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['order/return-sheet/view','id'=>$model->id])?>' class='button_link'><i class='icon-angle-left icon-large'></i>返回退货列表</a>
            <a href='<?=Url::to(['order/so-sheet/view','id'=>$outStockSheetModel->order_id])?>' class='button_link'><i class='icon-angle-left icon-large'></i>返回订单</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'outStockSheetModel'=>$outStockSheetModel
    ]) ?>

</div>
