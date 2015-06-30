<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\vip\VipAddress */

$this->title = '创建收货地址';
// $this->params['breadcrumbs'][] = ['label' => 'Vip Addresses', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="vip-address-create">


    <?=$this->render ( '_form', [ 'model' => $model,'provinces' => $provinces,'cities' => [ ],'districts' => [ ],'orderId'=>$orderId ] )?>

</div>
