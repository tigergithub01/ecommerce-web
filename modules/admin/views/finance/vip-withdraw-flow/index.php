<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use yii\grid\GridView;


$this->title = '会员提现申请';
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript">
function submitSearch(){
    document.getElementById('form_search').submit();
}

$(function(){
    $(".commitSheet").click(function(){
        var sheetID=$(this).attr("data-sheetID");       
        $("#withdraw_id").val(sheetID);
        $("#withdraw_redirectUrl").val(window.location.href);
        $("#form_withdraw").trigger('submit');
        return false;
    });
});
</script>

<div class="vip-withdraw-flow-index">

    <div class='clearfix h1div'>
        <div class='float-right'>
            
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>
  
<?php $form = ActiveForm::begin([
        'id'=>'form_withdraw',
        'action'=>['withdraw'],
]); ?>
    <input type="hidden" name='id' id='withdraw_id'>
    <input type="hidden" name='redirectUrl' id='withdraw_redirectUrl'>
<?php ActiveForm::end(); ?>
    
<div class='search_area'> 
    <form id='form_search' action='<?=Url::to()?>'>
        <?=Html::hiddenInput('r',$_GET['r'])?>
            用户帐户：
            <?=Html::input('text', 'name',yii::$app->request->get('name'),['class'=>'form-input'])?>          
            编号:
            <?=Html::input('text', 'code',yii::$app->request->get('vip_no'),['class'=>'form-input'])?>
            <input type="submit" class="hidden" value="">
            <a href="javascript:submitSearch();" class="button_link"><i class="icon-search icon-large"></i>查 询</a>        
    </form>
    </div> 

    <?= GridView::widget([
        'layout'=>'{items}{summary}{pager}',
        'dataProvider' => $dataProvider,
        'options'=>['class'=>'grid-view'],
        'columns' => [
            'id',
           [
             'label'=>'会员名称',
               'format'=>'raw',
               'value'=>function($model){
                   if($model->vip){
                        return Html::a($model->vip->name, ['vip/vip/view','id'=>$model->vip_id]);    
                    }
                    return "";
               }
           ],
            [
                'label'=>'编号',
                'attribute'=>'code',
                'enableSorting'=>false,
            ],           
            [
                'attribute'=>'apply_date',
                'enableSorting'=>false,
            ],
            [
                'attribute'=>'amount',
                'format'=>'decimal',
                'enableSorting'=>false,
            ], 
            [
                'attribute'=>'settled_amt',
                'format'=>'decimal',
                'enableSorting'=>false,
            ],
            [
                'attribute'=>'settled_date',            
                'enableSorting'=>false,
            ],            
            [
                'label'=>'状态',               
                'format'=>'raw',
                'headerOptions'=>['class'=>'center'],
                'contentOptions'=>['class'=>'center'],
                'value'=>function($model){
                    $html=$model->status?"<span class='msg_ok'>已结算</span>":"<span class='msg_forbid'>未结算</span>";                  
                    return $html;
                }
            ],
            [
                'label'=>'操作',               
                'format'=>'raw',
                'contentOptions'=>['class'=>'center'],
                'value'=>function($model){                    
                    $html=$model->status?"":Html::a('去结算', 'commit',['class'=>'button_link commitSheet','data-sheetID'=>$model->id]);
                    return $html;
                }
            ],
        ],
    ]); ?>    

</div>
