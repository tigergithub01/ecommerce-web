<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\Action2Column;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '后台操作日志';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-type-index">
    <script type="text/javascript">
        function submitSearch() {
            document.getElementById('form_search').submit();
        }        
       
    </script>
    <div class='clearfix h1div'>
        <div class='float-right'>
            <!--<a href='<?= Url::to(['create']) ?>' class='button_link'><i class='icon-plus-sign-alt icon-large'></i>添加新用户</a>-->
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div> 

    <!--
    <div class='search_area'> 
        <form id='form_search' action='<?= Url::to() ?>'>
            <?= Html::hiddenInput('r', $_GET['r']) ?>                  
            账号：<?= Html::input('text', 'name', yii::$app->request->get('name'), ['class' => 'form-input']) ?>
            <a href="javascript:submitSearch();" class="button_link"><i class="icon-search icon-large"></i>查 询</a>

        </form>
    </div> 
    -->

    <?=
    GridView::widget([
        'layout'=>'{items}{summary}{pager}',
        'dataProvider' => $dataProvider,
        'columns' => [           
            [
                'label'=>'时间',
                'value'=>'op_date'
            ],
            [
                'label'=>'用户',
                'value'=>'user_id'
            ],
            [
                'label'=>'模块',
                'value'=>function($model){                    
                    return $model['module_name'].'('.$model['module_code'].')';
                },
            ],
            [
                'label'=>'操作',
                'value'=>function($model){                    
                    return $model['operation_name'].'('.$model['operation_code'].')';
                },
            ],
            [
                'label'=>'IP地址',
                'value'=>'op_ip_addr'
            ],
            [
                'label'=>'浏览器',
                'value'=>'op_browser_type'
            ],
            [
                'label'=>'URL',
                'value'=>'op_url'
            ],
            [
                'label'=>'描述',
                'value'=>'op_desc'
            ]            
        ],
    ]);
    ?>

</div>
