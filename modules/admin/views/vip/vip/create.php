<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\vip\Vip */

$this->title = '添加会员';
$this->params['breadcrumbs'][] = ['label' => '会员列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vip-create">

    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['index'])?>' class='button_link'><i class=' icon-angle-left'></i>返回</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
