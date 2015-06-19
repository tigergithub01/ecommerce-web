<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\product\Product */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '产品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

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
    
    <h3>基本信息</h3>
    <?= DetailView::widget([
        'options'=>['class'=>'table_view'],
        'template'=>'<tr><td class="td-column" style="width:180px;">{label}</td><td>{value}</td></tr>',
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'name',
            'type_id',
            'price:decimal',            
            'status',            
            'stock_quantity:Integer',
            'safety_quantity:Integer',
            [
                'label'=>'创建信息',
                'format'=>'raw',
                'value'=>'创建人员：'.$model->CreateUserName.'('.$model['create_date'].')<br/>最后更新：'.$model->UpdateUserName."&nbsp;(".$model['update_date'].")"
            ],
            'description:ntext',          
        ],
    ]) ?>
    <h3>退货配置信息</h3>
    <?= DetailView::widget([
        'options'=>['class'=>'table_view'],
        'template'=>'<tr><td class="td-column" style="width:180px;">{label}</td><td>{value}</td></tr>',
        'model' => $model,
        'attributes' => [            
            [
                'attribute'=>'can_return_flag',
                'value'=>$model->can_return_flag?"可以":"不可以"
            ],
            'return_days',           
            'return_desc:ntext',
        ],
    ]) ?>
    <h3>分润信息</h3>
    <?= DetailView::widget([
        'options'=>['class'=>'table_view'],
        'template'=>'<tr><td class="td-column" style="width:180px;">{label}</td><td>{value}</td></tr>',
        'model' => $model,
        'attributes' => [           
            [
                'attribute'=>'special_deduct_flag',
                'value'=>$model->can_return_flag?"是":"否"
            ],
            'deduct_level1',
            'deduct_level2',
            'deduct_level3',      
            'deduct_level4',      
        ],
    ]) ?>
    <style type="text/css">
        .product_photo{ list-style:none;}
        .product_photo li { list-style:none;width:120px;height:80px;overflow:hidden;float:left;margin-right: 15px;margin-bottom:15px;}
        .product_photo li img {max-width: 100%;*width:100%;}
    </style>
    <h3>图片信息</h3>
    <ul class="product_photo clearfix">
    <?php foreach ($picModel as $pic) { ?>
        <li><a href="<?=Yii::getAlias('@web').$pic['url']?>" target="_blank"><image src="<?=Yii::getAlias('@web').$pic['url']?>"></a></li> 
    <?php } ?>
    </ul>

</div>
