<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\Action2Column;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '省份信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript">
function submitSearch(){
    document.getElementById('form_search').submit();
}
</script>
<div class="pay-type-index">

    <div class='clearfix h1div'>
        <div class='float-right'>
           
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div> 
    
    <div class='search_area'> 
    <form id='form_search' action='<?=Url::to()?>'>
        <?=Html::hiddenInput('r',$_GET['r'])?>                  
            名称：<?=Html::input('text', 'name',yii::$app->request->get('name'),['class'=>'form-input'])?>
            <a href="javascript:submitSearch();" class="button_link"><i class="icon-search icon-large"></i>查 询</a>
        
    </form>
    </div> 

    
    <?= GridView::widget([
         'layout'=>'{items}{summary}{pager}',
        'dataProvider' => $dataProvider,       
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'options'=>['style'=>'width:80px;'],
            ],           
            [
                'label'=>'省份',
                'value'=>'name',
            ],
            [
                'label'=>'查看',
                'format'=>'raw',
                'value'=>function($m){
                    return Html::a('市信息',['basic/city','province_id'=>$m->id]);
                },
            ],
        ],
    ]); ?>

</div>
