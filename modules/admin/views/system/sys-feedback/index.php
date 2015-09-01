<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\Action2Column;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员反馈列表';
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
                    return Html::a($model->vip->name, ['vip/vip/view','id'=>$model->vip_id]);                         
                },
                'headerOptions'=>[
                    'style'=>'width:100px;'
                ],
            ],           
            [
                'label'=>'内容',
                'value'=>'content'
            ], 
            [
                'label'=>'反馈时间',
                'value'=>'feedback_date',
                'headerOptions'=>[
                    'style'=>'width:120px;'
                ],
            ],
            [
                'label'=>'反馈类型',
                'value'=>'feedback_type',
                'headerOptions'=>[
                    'style'=>'width:120px;'
                ],
            ],
            [
                'label'=>'IP地址',
                'value'=>'ip_address',
                'headerOptions'=>[
                    'style'=>'width:100px;'
                ],
            ],
            [
                'label'=>'操作系统',
                'value'=>'os_type',
                'headerOptions'=>[
                    'style'=>'width:120px;'
                ],
            ],
            [
                'label'=>'手机型号',
                'value'=>'phone_model',
                'headerOptions'=>[
                    'style'=>'width:120px;'
                ],
            ],
            [
                'label'=>'联系方式',
                'value'=>'contact_method',
                'headerOptions'=>[
                    'style'=>'width:120px;'
                ],
            ],            
        ],
    ]);
    ?>

</div>
