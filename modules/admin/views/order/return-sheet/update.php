<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\product\ProductType */

$this->title = '修改退货单: ' . ' ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => '订单', 'url' => ['order/so-sheet/view','id'=>$outStockSheetModel->order_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="product-type-update">

   <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['order/return-sheet'])?>' class='button_link'><i class='icon-angle-left icon-large'></i>返回退货列表</a>
            <a href='<?=Url::to(['order/so-sheet/view','id'=>$model->order_id])?>' class='button_link'><i class='icon-angle-left icon-large'></i>返回订单</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>
   
    
    <?= $this->render('_form', [
        'model' => $model,
        'outStockSheetModel'=>$outStockSheetModel
    ]) ?>

</div>
