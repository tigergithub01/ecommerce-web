<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\Action2Column;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '配送方式';
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
            <a href='<?= Url::to(['create']) ?>' class='button_link'><i class='icon-plus-sign-alt icon-large'></i>添加配送方式</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div> 

    <div class='search_area'> 
        <form id='form_search' action='<?= Url::to() ?>'>
            <?= Html::hiddenInput('r', $_GET['r']) ?>                  
            名称：<?= Html::input('text', 'name', yii::$app->request->get('name'), ['class' => 'form-input']) ?>
            <a href="javascript:submitSearch();" class="button_link"><i class="icon-search icon-large"></i>查 询</a>

        </form>
    </div> 

    <?=
    GridView::widget([
        'layout'=>'{items}{summary}{pager}',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','headerOptions'=>[
                'style'=>'width:100px;'
            ]],          
            'code',
            'name',
            [
                'label'=>'状态',
                'value'=>function($m){
                    return $m->getStatusText();
                },
            ],
           [
                'label'=>'备注',
                'value'=>'description',
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
