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
                'headerOptions'=>['style'=>"width:100px;"],
                'value'=>'op_date'
            ],
            [
                'label'=>'用户',
                'headerOptions'=>['style'=>"width:100px;"],
                'value'=>'user_id'
            ],            
            [
                'label'=>'IP地址',
                'headerOptions'=>['style'=>"width:100px;"],
                'value'=>'op_ip_addr'
            ],           
            [
                'label'=>'描述',
                'headerOptions'=>['style'=>"width:150px;"],
                'value'=>'op_desc'
            ],
            [
                'label'=>'数据',
                'format'=>'raw',
                'value'=>function($m){
                    $h=$m['op_data'];
                    if(strlen($h)>200){
                        $h=  substr($h, 0,300).'...';
                    }
                    return "<div style='word-wrap:break-word;word-break:break-all;'>".Html::encode($h)."</div>";
                }
            ],
                      
        ],
    ]);
    ?>

</div>
