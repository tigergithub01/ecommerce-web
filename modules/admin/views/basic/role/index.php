<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\Action2Column;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色列表';
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

    <div class='search_area'> 
        <form id='form_search' action='<?= Url::to() ?>'>
            <?= Html::hiddenInput('r', $_GET['r']) ?>                  
            账号：<?= Html::input('text', 'name', yii::$app->request->get('name'), ['class' => 'form-input']) ?>
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
            [
                'label'=>'角色名称',
                'value'=>'name'
            ],
            [
                'label'=>'描述',
                'value'=>'description'
            ]            
        ],
    ]);
    ?>

</div>
