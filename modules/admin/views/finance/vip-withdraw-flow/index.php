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
        if(!window.confirm("确定要去结算吗？")){            
            return false;
        }
        var sheetID=$(this).attr("data-sheetID");       
        $("#form_withdraw input[name='id']").val(sheetID);
        $("#withdraw_redirectUrl").val(window.location.href);
        $("#form_withdraw").trigger('submit');
        return false;
    });
    
     $(".confirmCommitSheet").click(function(){
        if(!window.confirm("确定要结算完成吗？")){            
            return false;
        }
        var sheetID=$(this).attr("data-sheetID");       
        $("#form_confirmWithdraw input[name='id']").val(sheetID);
        $("#withdraw_redirectUrl").val(window.location.href);
        $("#form_confirmWithdraw").trigger('submit');
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
    
<?php $form = ActiveForm::begin([
        'id'=>'form_confirmWithdraw',
        'action'=>['confirm-withdraw'],
]); ?>
    <input type="hidden" name='id'>
    <input type="hidden" name='redirectUrl' id='confirmWithdraw_redirectUrl'>
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
                    $html="";
                    switch($model['status']){
                            case 0:
                                $html="<span class='msg_forbid'>未结算</span>";
                                break;
                            case 1:
                                $html="<span class='msg_ok'>已结算</span>";
                                break;
                            case 2:
                                $html="<span class='msg_primary_f'>结算中</span>";
                                break;
                            default:
                                $html="<span class='msg_forbid'>未知状态</span>";
                                break;
                    }               
                                  
                    return $html;
                }
            ],
            [
                'label'=>'操作',               
                'format'=>'raw',
                'contentOptions'=>['class'=>'center'],
                'value'=>function($model){
                    $html="";
                    switch($model['status']){
                        case 0:
                                $html=Html::a('去结算', 'commit',['class'=>'button_link commitSheet','data-sheetID'=>$model->id]);
                                break;                           
                            case 2:
                                $html=Html::a('结算完成', 'commit',['class'=>'button_link confirmCommitSheet msg_warning','data-sheetID'=>$model->id]);
                                break;                          
                    }                   
                    return $html;
                }
            ],
        ],
    ]); ?>    

</div>
