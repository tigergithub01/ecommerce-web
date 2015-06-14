<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\product\ProductType */

$this->title = '添加产品类别';
$this->params['breadcrumbs'][] = ['label' => '产品类别', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-create">

    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['index'])?>' class='button_link'><i class='icon-angle-left icon-large'></i>返回</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'parentModel'=>$parentModel,
    ]) ?>

</div>
