<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\product\ProductType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '产品类别', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model_view">

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
            <td class="td-column" style="width:150px;">主键编号</td>
            <td ><?=html::encode($model->id) ?></td>
        </tr>
        <tr>
            <td class="td-column" style="width:150px;">类别名称</td>
            <td ><?=html::encode($model->name) ?></td>
        </tr>
        <tr>
            <td class="td-column" style="width:150px;">上级类别</td>
            <td ><?=html::encode($model->parent?$model->parent->name:'(未设置)') ?></td>
        </tr>
        <tr>
            <td class="td-column" style="width:150px;">描述</td>
            <td ><?=html::encode($model->description) ?></td>
        </tr>
    </table>


</div>
