<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = '退货单';
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
                'label'=>'退货单编号',
                'format'=>'raw',
                'value'=>function($m){
                    return Html::a($m->code, ['order/return-sheet/update','id'=>$m->id]);
                }
            ],
            [
                'label'=>'待退货金额',
                'format'=>'decimal',
                'value'=>'return_amt',
            ],          
            [
                'label'=>'状态',              
                'value'=>function($m){
                    return $m['statusType']['pa_val'];
                }
            ],
            [
                'label'=>'制单时间',
                'value'=>'sheet_date',
            ],
            [
                'label'=>'备注',
                'value'=>'memo',
            ]                      
        ],
    ]); ?>

</div>
