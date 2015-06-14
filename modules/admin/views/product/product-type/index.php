<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\CheckboxColumn;
use app\components\Action2Column;
use yii\widgets\ActiveForm;

$this->title = '产品类别';
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
            <a href='<?=Url::to(['create'])?>' class='button_link'><i class='icon-plus-sign-alt icon-large'></i>添加产品类别</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div> 
    
    <div class='search_area'> 
    <form id='form_search' action='<?=Url::to()?>'>
        <?=Html::hiddenInput('r',$_GET['r'])?>
                  
            <?=Html::input('text', 'name',yii::$app->request->get('name'),['class'=>'form-input'])?>
            <a href="javascript:submitSearch();" class="button_link"><i class="icon-search icon-large"></i>查 询</a>
        
    </form>
    </div> 
         
    

    <?= GridView::widget([
        'layout'=>'{items}{summary}{pager}',
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => CheckboxColumn::className(),
                'options'=>[
                    'style'=>'width:50px;'
                    ]
            ],
            [
              'attribute'=>'id',
                'options'=>['style'=>'width:100px;']
            ],
            'name',
            [                
                'label'=>'上级分类',
                'format'=>'raw',
                'value'=>function($data){
                   if($data->parent){                       
                       return Html::a($data->parent->name,['index','parent_id'=>$data->parent->id]);
                   }else{
                       return "";
                   }                    
                }
            ],
            'description',
            ['class' => Action2Column::className(),
                'header'=>'操作',
                'headerOptions'=>['style'=>"text-align:center;width:100px;"],
                'contentOptions'=>['style'=>"text-align:center;"]
            ],
        ],
    ]); ?>

</div>
