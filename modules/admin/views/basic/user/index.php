<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\Action2Column;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '后台用户管理';
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
            <a href='<?= Url::to(['create']) ?>' class='button_link'><i class='icon-plus-sign-alt icon-large'></i>添加新用户</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div> 

    <div class='search_area'> 
        <form id='form_search' action='<?= Url::to() ?>'>
            <?= Html::hiddenInput('r', $_GET['r']) ?>                  
            账号：<?= Html::input('text', 'user_name', yii::$app->request->get('user_name'), ['class' => 'form-input']) ?>
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
                'label'=>'登录账号',
                'value'=>'user_id'
            ],
            [
                'label'=>'姓名',
                'value'=>'user_name'
            ],
            [
                'label'=>'最后登录时间',
                'value'=>'last_login_date'
            ],           
            [
                'label'=>'创建时间',
                'value'=>'create_date'
            ],
            [
                'label'=>'修改密码',
                'format'=>'raw',
                'value'=>function($m){
                    return Html::a('修改密码',['change-password','id'=>$m->id],['data-user-id'=>$m->id,'class'=>'change-password-trigger']);
                }
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
