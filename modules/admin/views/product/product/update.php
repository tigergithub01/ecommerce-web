<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\product\Product */

$this->title = '修改产品: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '产品类别', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="product-update">

    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['index'])?>' class='button_link'><i class=' icon-angle-left'></i>返回列表</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'productPicModel'=>$productPicModel,
        'productPicNewModel'=>$productPicNewModel,
        'typeName'=>$typeName
    ]) ?>

</div>
