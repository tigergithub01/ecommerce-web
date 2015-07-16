<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\Action2Column;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员收入信息';
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
            <a href='<?=Url::to(['create'])?>' class='button_link'><i class='icon-plus-sign-alt icon-large'></i>添加会员</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>
    
<div class='search_area'> 
    <form id='form_search' action='<?=Url::to()?>'>
        <?=Html::hiddenInput('r',$_GET['r'])?>
            会员名称：
            <?=Html::input('text', 'name',yii::$app->request->get('name'),['class'=>'form-input'])?>
            手机号码:
            <?=Html::input('text', 'vip_no',yii::$app->request->get('vip_no'),['class'=>'form-input'])?>
            <input type="submit" class="hidden" value="">
            <a href="javascript:submitSearch();" class="button_link"><i class="icon-search icon-large"></i>查 询</a>
        
    </form>
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
                'attribute'=>'amount',
                'format'=>'decimal',
                'enableSorting'=>false,
            ],           
            [
                'attribute'=>'can_settle_amt',
                'format'=>'decimal',
                'enableSorting'=>false,
            ],
            [
                'attribute'=>'settled_amt',
                'format'=>'decimal',
                'enableSorting'=>false,
            ], 
            [
                'attribute'=>'can_withdraw_amt',
                'format'=>'decimal',
                'enableSorting'=>false,
            ],
            [
                'label'=>'',
                'format'=>'raw',
                'value'=>function($m){
                    return Html::a('查看记录', ['vip/vip-income-detail','vip_id'=>$m->vip_id]);
                }
            ],
        ],
    ]); ?>

</div>
