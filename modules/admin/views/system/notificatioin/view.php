<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\system\AdInfo */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '我要赚钱列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-info-view">

    <div class='clearfix h1div'>
        <div class='float-right'>
            <?= Html::a('<i class="icon-pencil"></i>修改', ['update', 'id' => $model->id], ['class' => 'button_link btn-primary']) ?>
            <?= Html::a('<i class="icon-plus-sign"></i>添加', ['create'], ['class' => 'button_link btn-primary']) ?>
            <?= Html::a('<i class="icon-trash"></i>删除', ['delete', 'id' => $model->id], [
                'class' => 'button_link btn-danger',
                'data' => [
                    'confirm' => '你确认要删除这条记录?',
                    'method' => 'post',
                ],
            ]) ?>
            <a href='<?=Url::to(['index'])?>' class='button_link'><i class=' icon-angle-left'></i>返回列表</a>
        </div>        
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>
   
    
    <table class="table_view" cellspacing="0">
        <tr>
            <td class="td-column" style="width:150px;">ID</td>
            <td >
                <?=html::encode($model->id) ?>
            </td>
        </tr>
        <tr>
            <td class="td-column" style="width:150px;">发布范围</td>
            <td ><?=html::encode($model->scopeType->pa_val) ?></td>
        </tr>
        <tr>
            <td class="td-column" style="width:150px;">标题</td>
            <td >
               <?=html::encode($model->title) ?>
            </td>
        </tr>
        <tr>
            <td class="td-column" style="width:150px;">内容</td>
            <td ><?=html::encode($model->content) ?></td>
        </tr>
        <tr>
            <td class="td-column" style="width:150px;">发布时间</td>
            <td ><?=html::encode($model->issue_date) ?></td>
        </tr>        
    </table>

</div>
