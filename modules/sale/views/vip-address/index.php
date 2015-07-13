<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\AppAsset;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
AppAsset::register ( $this );
$this->title = '收货地址列表';
$this->params ['breadcrumbs'] [] = $this->title;
$this->params['show_nav']=1;
?>
<style type="text/css">
header{
	display: table;
}

</style>
<div class="vip-address-index" style="padding: 2px;">
	<!-- 
	<a style="margin-top: 5px;"  href="<?= Url::toRoute(['/sale/vip-center/index'])?>">个人中心</a>-><a href="<?= Url::toRoute(['/sale/vip-address/index'])?>">收货地址列表</a>
	<hr>
	 -->
	<p style="text-align: center;">
        <?= Html::a('新建收货地址', ['create','orderId' => $orderId], ['class' => 'btn btn-success']) ?>
    </p>
    <hr>
    <?php foreach ($dataList as $model) {?>
    <div style="padding-left: 10px;">
    	<?php if(!empty($orderId)){?>
    	<div>
    	<?= Html::a('选择', ['select', 'orderId' => $orderId,'id'=>$model['id']], ['class' => 'btn btn-primary']) ?>
    	</div>
    	<?php }?>
		<div>
    	姓       名：<?= $model['name']?>
    	</div>
		<div>
    	手机号码：<?= $model['phone_number']?>
    	</div>
		<div>
    	收货地址：
    	<?php
					$address = $model->areaSort;
					echo $address ['provnce'] . $address ['city'] . $address ['district']?>
    	</div>
		<div>
    	是否默认收货地址：<?=$model['default_flag']==1?'是':'否'?>
    	</div>
		<div style="text-align: right;">
			<?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '是否删除?',
                'method' => 'post',
            ],
        ]) ?>
         <?= Html::a('编辑', ['update', 'id' => $model->id,'orderId' => $orderId], ['class' => 'btn btn-primary']) ?>
		</div>
		<hr>
	</div>
    	
    <?php }?>

</div>
