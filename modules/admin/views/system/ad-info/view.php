<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\system\AdInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '广告列表', 'url' => ['index']];
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
            <td class="td-column" style="width:150px;">图片地址</td>
            <td >
                <div style="width:220px;overflow:hidden;">
                    <img src="<?=Yii::getAlias('@web/upload/ad/').html::encode($model->image_url)?>" style="max-width: 100%;">         
                </div>        
            </td>
        </tr>
        <tr>
            <td class="td-column" style="width:150px;">排序</td>
            <td ><?=html::encode($model->sequence_id) ?></td>
        </tr>
        <tr>
            <td class="td-column" style="width:150px;">跳转URL</td>
            <td ><?=html::encode($model->redirect_url) ?></td>
        </tr>
    </table>

</div>
