<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\MydialogWidget;
use app\components\Action2Column;

\app\assets\ZTreeAsset::register($this);
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '产品列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type='text/css'>
    .product_name{ font-size:14px;}
</style>
<script type="text/javascript">
function submitSearch(){
    document.getElementById('form_search').submit();
}
</script>
<div class="product-index">
    
    <div class='clearfix h1div'>
        <div class='float-right'>
            <a href='<?=Url::to(['create'])?>' class='button_link'><i class='icon-plus-sign-alt icon-large'></i>添加新产品</a>
        </div>
        <strong class='title'><?= Html::encode($this->title) ?></strong>
    </div>
    
<div class='search_area'> 
    <form id='form_search' action='<?=Url::to()?>'>
        <?=Html::hiddenInput('r',$_GET['r'])?>
            产品名称：
            <?=Html::input('text', 'name',yii::$app->request->get('name'),['class'=>'form-input'])?>
            分类：
            <?=Html::input('hidden', 'type_id',yii::$app->request->get('type_id'),['id'=>'type_id'])?>
            <?=Html::input('text', 'type_text',yii::$app->request->get('type_text'),['id'=>'type_text','class'=>'form-input'])?>
            <a href="#" style="color:#00b0df;" data-mydialog-target="#mw1" class="mydialog-trigger"><i class=" icon-folder-open"></i>选取分类</a>
            <a href="javascript:submitSearch();" class="button_link"><i class="icon-search icon-large"></i>查 询</a>
        
    </form>
    </div> 
    

    <?= GridView::widget([
        'layout'=>'{items}{summary}{pager}',
        'dataProvider' => $dataProvider,
        'columns' => [
            [
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'format'=>'raw',
            'value' => function ($model) {
                    return '<span class="product_name">'.$model->name.'</span><br/><span class="td_tip">编码：'.$model->code."</span>";
                },
            ],
            [
                'label'=>'分类',
                'value'=>function($d){ return $d->productType->name;}                
            ],
            'price:Decimal',
            // 'description:ntext',
            // 'status',
            'stock_quantity:Integer',
            'safety_quantity:Integer',         
             'create_date',           
            ['class' => Action2Column::className(),
                'header'=>'操作',
                'headerOptions'=>['style'=>"text-align:center;"],
                'contentOptions'=>['style'=>"text-align:center;"]
            ],
        ],
    ]); ?>

</div>

<?php MydialogWidget::begin(['id'=>'mw1','title'=>'选中产品类别']);?>
<div id="treeDemo" class="ztree" style="height:300px;overflow:auto"></div>
<div style="text-align:center;">
    <a href="javascript:getProductType();" class="btn">确 定</a>
    <a href="#" class="btn btn_gray unblockui-trigger">取 消</a>
</div>
<?php MydialogWidget::end();?>
<script type="text/javascript">
    var treeobj=null;
    
    $(function(){
        var setting = {
            async: {
                    enable: true,
                    url:"<?=Url::to(['product/product-type/get-json'])?>",
                    type:"get",
                    autoParam:['id=parent_id'],
                    otherParam:{}                    
            }
        };

    
        treeobj=$.fn.zTree.init($("#treeDemo"), setting,[{ name:"产品类型", open:true,'parent_id':null,isParent:true}]);
    });
    
    function getProductType(){
        var c=treeobj.getSelectedNodes();        
        if(c.length>0){
            $("#type_id").val(c[0]['id']);
            $("#type_text").val(c[0]['name']);
            $.unblockUI();
        }
        
    }
</script>