<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\vip\VipAddress */

$this->title = '编辑收货地址';
// $this->title = 'Update Vip Address: ' . ' ' . $model->name;
// $this->params['breadcrumbs'][] = ['label' => 'Vip Addresses', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="vip-address-update wrapper">

   

   <?=$this->render ( '_form', [ 'model' => $model,'provinces' => $provinces,'cities' => $cities,'districts' => $districts,'orderId'=>$orderId ] )?>

</div>
