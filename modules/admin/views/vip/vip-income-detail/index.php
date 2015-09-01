<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\Action2Column;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '收入明细';
$this->params['breadcrumbs'][] = ['label' => '收入明细', 'url' => ['vip/vip-income/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript">
function submitSearch(){
    document.getElementById('form_search').submit();
}
</script>
<div class="vip-index">

  <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['vip/vip-income/index'])?>' class='button_link'><i class=' icon-angle-left'></i>返回</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
   </div>
    
    <?= GridView::widget([
        'layout'=>'{items}{summary}{pager}',
        'dataProvider' => $dataProvider,
        'options'=>['class'=>'grid-view'],
        'columns' => [
           [
                'label'=>'会员',
                'format'=>'raw',
                'value'=>function($model){ 
                    if($model->vip){
                        return Html::a($model->vip->name, ['vip/vip/view','id'=>$model->vip_id]);    
                    }
                    return "";
                },
                'headerOptions'=>[
                    'style'=>'width:100px;'
                ],
            ],
            [
                'label'=>'贡献分润会员',
                'format'=>'raw',
                'value'=>function($model){ 
                    if($model->subVip){
                        return Html::a($model->subVip->name, ['vip/vip/view','id'=>$model->sub_vip_id]);    
                    }
                    return "";
                },
                'headerOptions'=>[
                    'style'=>'width:100px;'
                ],
            ],
            [
                'attribute'=>'amount',
                'format'=>'decimal',
                'headerOptions'=>[
                    'style'=>'width:180px;'
                ],
                'enableSorting'=>false,
            ],           
            [
                'attribute'=>'deduct_price',
                'format'=>'decimal',
                'headerOptions'=>[
                    'style'=>'width:180px;'
                ],
                'enableSorting'=>false,
            ],
            [
                'label'=>'产品',
                'format'=>'raw',
                'value'=>function($model){ 
                    if($model->vip){
                        return Html::a($model->product->name, ['product/product/view','id'=>$model->product_id]);    
                    }
                    return "";
                },                
            ],
            [
                'label'=>'详细',
                'format'=>'raw',
                'value'=>function($model){ 
                    if($model->vip){
                        return Html::a('查看关联订单', ['order/so-sheet/view','id'=>$model->order_id]);                                
                    }
                    return "";
                },
                'headerOptions'=>[
                    'style'=>'width:100px;'
                ],
            ],
        ],
    ]); ?>


</div>
