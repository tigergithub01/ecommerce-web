<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\product\ProductType */

$this->title = '修改发货单';
$this->params['breadcrumbs'][] = ['label' => '发货单', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['order/out-stock-sheet'])?>' class='button_link'><i class='icon-angle-left icon-large'></i>返回发货单列表</a>
            <a href='<?=Url::to(['order/so-sheet/view','id'=>$model->order_id])?>' class='button_link'><i class='icon-angle-left icon-large'></i>返回订单</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>

    <?= $this->render('_form', [
        'model' => $model        
    ]) ?>

</div>>
