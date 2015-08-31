<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\basic\DeliveryType */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => '后台用户', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$roles=$model->getRoleList();

?>
<div class="delivery-type-view">

     <div class='clearfix h1div'>
        <div class='float-right'>
            <?= Html::a('<i class="icon-pencil"></i>修改', ['update', 'id' => $model->id], ['class' => 'button_link btn-primary']) ?>
            <?= Html::a('<i class="icon-pencil"></i>修改密码', ['change-password','id'=>$model->id], ['class' => 'button_link btn-primary']) ?>           
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
            'user_id',
            'user_name',           
            [
                'attribute'=>'status',
                'value'=>$model->getStatusText()
            ],
            'last_login_date',
            'create_date',
            /*
            [
                'label'=>'角色',
                'format'=>'raw',
                'value'=>implode('，',ArrayHelper::getColumn($roles, 'name'))
            ]*/
        ],
    ]) ?>

</div>
