<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员操作日志';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .adImage {max-width:120px;*width:120px;}
    .wordwrap {word-break:break-all; word-wrap:break-word;}
 </style>
<div class="ad-info-index">

   <script type="text/javascript">
        function submitSearch() {
            document.getElementById('form_search').submit();
        }        
       
    </script>
   
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
                'label'=>'会员',
                'format'=>'raw',
                'value'=>function($model){ 
                    if($model->vip){
                        return Html::a($model->vip->name, ['vip/vip/view','id'=>$model->vip_id]);    
                    }
                    return "";
                },
                'headerOptions'=>[
                    'style'=>'width:80px;'
                ],
            ],           
            [
                'label'=>'模块',
                'value'=>function($model){ 
                    if($model->module){
                        return $model->module->name;
                    }
                    return '';                   
                },
                'headerOptions'=>[
                    'style'=>'width:120px;'
                ],
            ], 
            [
                'label'=>'日期',
                'value'=>'op_date',
                'headerOptions'=>[
                    'style'=>'width:80px;'
                ],
            ],
            [
                'label'=>'IP地址',
                'value'=>'op_ip_addr',
                'headerOptions'=>[
                    'style'=>'width:120px;'
                ],
            ],
            [
                'label'=>'浏览器',
                'value'=>'op_browser_type',
                'headerOptions'=>[
                    'style'=>'width:100px;'
                ],
            ],
            [
                'label'=>'手机型号',
                'value'=>'op_phone_model',
                'headerOptions'=>[
                    'style'=>'width:120px;'
                ],
            ],
            [
                'label'=>'URL',
                'value'=>'op_url',
                'headerOptions'=>[
                    'style'=>'width:120px;'
                ],
            ],
            [
                'label'=>'操作描述',
                'value'=>'op_desc',
                'contentOptions'=>[
                    'class'=>'wordwrap'
                ],
            ],            
        ],
    ]);
    ?>

</div>
