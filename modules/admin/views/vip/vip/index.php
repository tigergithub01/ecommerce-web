<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\Action2Column;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '注册会员';
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
            名称：
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
             'label'=>'会员名称',
               'format'=>'raw',
               'value'=>function($model){
                   return "<strong>".$model->name."</strong><br/><span class='td_tip'>ID:".$model->id."</span>";
               }
           ],
            [
                'attribute'=>'vip_no',
                'enableSorting'=>false,
            ],           
            [
                'attribute'=>'name',
                'enableSorting'=>false,
            ],
            [
                'attribute'=>'id_card',
                'enableSorting'=>false,
            ],           
            'last_login_date',
            
            [
                'label'=>'状态',
                'attribute'=>'status',
                'format'=>'raw',
                'value'=>function($model){
                    return $model->status?"<span class='msg_ok'><i class='icon-ok'></i>正常</span>":"<span class='msg_forbid'><i class=' icon-lock'></i>禁用</span>";
                }
            ],            
             'register_date',
            ['class' => Action2Column::className(),
                'header'=>'操作',
                'headerOptions'=>['style'=>"text-align:center;"],
                'contentOptions'=>['style'=>"text-align:center;"]
            ],
        ],
    ]); ?>

</div>
