<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\basic\PayType */

$this->title = $model->name.$model->code;
$this->params['breadcrumbs'][] = ['label' => 'Pay Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pay-type-view">

    <div class='clearfix h1div'>
        <div class='float-right'>
            <?= Html::a('<i class="icon-pencil"></i>修改', ['update', 'id' => $model->id], ['class' => 'button_link btn-primary']) ?>
            <?= Html::a('<i class="icon-plus-sign"></i>添加', ['create'], ['class' => 'button_link btn-primary']) ?>            
            <a href='<?=Url::to(['index'])?>' class='button_link'><i class=' icon-angle-left'></i>返回列表</a>
        </div>        
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>

   

    <?= DetailView::widget([
        'options'=>['class'=>'table_view'],
         'template' => "<tr><td class='td-column' style='width:150px;'>{label}</td><td>{value}</td></tr>",
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'name',
            'rate',
            [
                'attribute'=>'status',
                'value'=>$model->getStatusText()
            ],
            'description',            
        ],
    ]) ?>

</div>
