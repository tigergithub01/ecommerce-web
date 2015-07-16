<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\Action2Column;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '消息通知';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .adImage {max-width:120px;*width:120px;}
 </style>
<div class="ad-info-index">

   <script type="text/javascript">
        function submitSearch() {
            document.getElementById('form_search').submit();
        }        
       
    </script>
    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?= Url::to(['create']) ?>' class='button_link'><i class='icon-plus-sign-alt icon-large'></i>添加记录</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div> 
<!--
    <div class='search_area'> 
        <form id='form_search' action='<?= Url::to() ?>'>
            <?= Html::hiddenInput('r', $_GET['r']) ?>                  
            <?= Html::input('text', 'user_name', yii::$app->request->get('user_name'), ['class' => 'form-input']) ?>
            <a href="javascript:submitSearch();" class="button_link"><i class="icon-search icon-large"></i>查 询</a>

        </form>
    </div>
-->
    <?=
    GridView::widget([
        'layout'=>'{items}{summary}{pager}',
        'dataProvider' => $dataProvider,        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','headerOptions'=>[
                'style'=>'width:30px;'
            ]],
            [
                'label'=>'ID',
                'value'=>'id',
                 'headerOptions'=>[
                    'style'=>'width:50px;'
                ],
            ],           
            [
                'label'=>'发布范围',
                'value'=>function($m){
                    return $m->scopeType->pa_val;
                },
                'headerOptions'=>[
                    'style'=>'width:80px;'
                ],
            ], 
            [
                'label'=>'标题',
                'value'=>'title',
                'headerOptions'=>[
                    'style'=>'width:250px;'
                ],
            ],
            [
                'label'=>'内容',
                'value'=>'content'
            ],  
            [
                'label'=>'发布日期',
                'value'=>'issue_date',
                'headerOptions'=>[
                    'style'=>'width:120px;'
                ],
            ],           
            ['class' => Action2Column::className(),
                'header'=>'操作',
                'headerOptions'=>['style'=>"text-align:center;width:100px;"],
                'contentOptions'=>['style'=>"text-align:center;"]
            ],
        ],
    ]);
    ?>

</div>
