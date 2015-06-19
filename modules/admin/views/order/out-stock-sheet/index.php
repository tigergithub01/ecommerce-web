<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = '发货单';
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript">
function submitSearch(){
    document.getElementById('form_search').submit();
}
</script>
<div class="product-type-index">

    <div class='clearfix h1div'>
        <div class='float-right'>
            
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div> 
    
    <div class='search_area'> 
    <form id='form_search' action='<?=Url::to()?>'>
        <?=Html::hiddenInput('r',$_GET['r'])?>                  
            编号：<?=Html::input('text', 'code',yii::$app->request->get('code'),['class'=>'form-input'])?>
            <a href="javascript:submitSearch();" class="button_link"><i class="icon-search icon-large"></i>查 询</a>
        
    </form>
    </div> 
         
    

    <?= GridView::widget([
        'layout'=>'{items}{summary}{pager}',
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label'=>'发货单编号',
                'format'=>'raw',
                'value'=>function($m){
                    return Html::a($m->code, ['order/out-stock-sheet/update','id'=>$m->id]);
                }
            ],
            [
                'label'=>'运费',
                'format'=>'decimal',
                'value'=>'deliver_fee',
            ],             
            [
                'label'=>'发货单编号',
                'value'=>'delivery_no',
            ], 
            [
                'label'=>'快递公司',
                'value'=>function($m){
                    return $m['deliveryInfo']['name'];
                }                
            ], 
            [
                'label'=>'状态',              
                'value'=>function($m){
                    return $m['statusData']['pa_val'];
                }
            ],
            [
                'label'=>'备注',
                'value'=>'memo',
            ]                      
        ],
    ]); ?>

</div>
