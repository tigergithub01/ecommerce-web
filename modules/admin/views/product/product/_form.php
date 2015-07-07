<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\components\MyDialogWidget;
use app\models\basic\Parameter;
$refundModel=Parameter::findAll(['type_id'=>8]);
$refundList=yii\helpers\ArrayHelper::map($refundModel, 'id', 'pa_val');

/* @var $this yii\web\View */
/* @var $model app\models\product\Product */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('@web/js/jquery.easytabs.min.js');
\app\assets\ZTreeAsset::register($this);
?>

<script type="text/javascript">
$(function(){
    $('#tab-container').easytabs({'animate':false});
    
    $.validator.addMethod("special_deduct_flag", function(value, element) {        
        var s=0;
        
        if(!$("#product-special_deduct_flag").val()){return true;}
        $("#tbodyDeductFlag input:text").each(function(i,n){
            s+=parseFloat($(this).val());
        });
       return s==100;

    }, "分级分润比例加起来需要等于100");

    $("#form1").validate({
            debug: false,
            onfocusout: function (element) {
                $(element).valid();
            },
            errorElement: 'label',
            errorClass: 'has-error',                     
            messages:{
                
            }
        });
})

function chooseType(){
    
}

function changeDeductFlag(sender){
    $("#tbodyDeductFlag").css("display",(sender.checked?"":"none"));
}
</script>
  <?php $form = ActiveForm::begin([
        'id'=>'form1',
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig'=>[ 
           
        ]
    ]); ?>

<?php if($model->errors){
    echo Html::errorSummary($model,['header'=>'输入有误，请检查：','class'=>'error-summary']);     
}?>

<style type="text/css">
    #olpic{ list-style: none;}
    #olpic li { margin:5px 0px;}
    #olpic li a { margin-right: 10px;}
    #picfieldcontainer img.productImg{
        width:120px;
        margin:20px 10px;
        display:block;
    }
    .picwrap{ position: relative;}
    .picwrap a{ display: block;margin:10px 5px;}
    #fengmian { background-color:#ff0000;color:#fff;padding:5px;position: absolute;top:-3px;left:115px;border-radius:5px;display:none; }
</style>

<div id="tab-container" class="tab-container">
  <ul class='etabs'>
        <li class='tab'><a href="#tabs1-html">基本信息</a></li><li class='tab'><a href="#tabs1-js">退货信息</a></li><li class='tab'><a href="#tabs1-css">结算信息</a></li><li class='tab'><a href="#tabsl-pic">图片信息</a></li>
  </ul>
    
  <div id="tabs1-html">
   <table class="table_edit">
       <?php if(!$model->isNewRecord) { ?>
        <tr>
            <td class="td-column">产品编码</td>
            <td class="">
                <?=Html::activeInput('text', $model, 'code',['class'=>'form-input input-readonly','disabled'=>'disabled']) ?>
                <span class="input-tip">系统自动生成</span>
            </td>
        </tr>
       <?php } ?>
        <tr>
            <td class="td-column">产品名称</td>
            <td class=""><?=Html::activeInput('text', $model, 'name',['maxlength' => 60,'class'=>'form-input']) ?></td>
        </tr>
        <tr>
            <td class="td-column">产品所属分类</td>
            <td class="">
                <?=Html::activeInput('hidden', $model, 'type_id',['class'=>'form-input']) ?>
                <input type="text" id="productTypeText" name="productTypeText" class="form-input" readonly="readonly" value="<?=$typeName?>">                
                <a href="#" style="color:#00b0df;" data-mydialog-target="#mw1" class="mydialog-trigger"><i class=" icon-folder-open"></i>选取分类</a>
            </td>
        </tr>
        <tr>
            <td class="td-column">价格</td>
            <td class=""><?=Html::activeInput('text', $model, 'price',['maxlength' => 20,'class'=>'form-input']) ?></td>
        </tr>
         <tr>
            <td class="td-column">成本价</td>
            <td class=""><?=Html::activeInput('text', $model, 'cost_price',['maxlength' => 20,'class'=>'form-input']) ?></td>
        </tr>
        <tr>
            <td class="td-column">产品状态</td>
            <td class="">
               <?=Html::activeDropDownList($model,'status', [1=>'正常',0=>'下架'],['class'=>'form-select'])?>               
            </td>
        </tr>
        <tr>
            <td class="td-column">库存数量</td>
            <td class=""><?=Html::activeInput('text', $model, 'stock_quantity',['class'=>'form-input']) ?></td>
        </tr>
        <tr>
            <td class="td-column">安全库存</td>
            <td class=""><?=Html::activeInput('text', $model, 'safety_quantity',['class'=>'form-input']) ?></td>
        </tr>
        <tr>
            <td class="td-column">产品描述</td>
            <td class=""><?=Html::activeTextarea($model, 'description',['class'=>'form-input form-textarea','style'=>'width:80%;']) ?></td>
        </tr>
   </table>
  </div>
    
  <div id="tabs1-js">
      <table class="table_edit">
          <tr>
            <td class="td-column">是否能退货</td>
            <td class="">
                <?=Html::dropDownList('Product[can_return_flag]',$model->status,['可以正常退货','不允许退货'],['class'=>'form-select']) ?>
            </td>        
        </tr>
        <tr>
            <td class="td-column">可退货天数</td>
            <td class=""><?=Html::activeInput('text', $model, 'return_days',['class'=>'form-input']) ?></td>
        </tr>
        <tr>
            <td class="td-column">退货规则描述</td>
            <td class=""><?=Html::activeTextarea($model, 'return_desc',['class'=>'form-input form-textarea','style'=>'width:80%;']) ?></td>
        </tr>
      </table>
  </div>
    
  <div id="tabs1-css">
      <table class="table_edit">
          <tbody>
      <tr>
            <td class="td-column">结算规则类别</td>
            <td class="">
                <?=Html::activeDropDownList($model, 'regular_type_id', $refundModel,['class'=>'form-select'])?>        
            </td>
        </tr>
        <tr>
            <td class="td-column">产品分润单价</td>
            <td class=""><?=Html::activeInput('text', $model, 'deduct_price',['class'=>'form-input']) ?></td>
        </tr>
        <tr>
            <td class="td-column">单独设置分润比例:</td>
            <td class="">
                <?=Html::activeCheckbox($model, 'special_deduct_flag',['onchange'=>'changeDeductFlag(this)','class'=>'special_deduct_flag']) ?><strong class="red">(分级分润比例加起来需要等于100)</strong>
            </td>
        </tr>
        </tbody>
        <tbody id="tbodyDeductFlag" style="display:<?=$model->special_deduct_flag?'':'none'?> ">
        <tr>
            <td class="td-column">一级分润比例</td>
            <td class=""><?=Html::activeInput('text', $model, 'deduct_level1',['class'=>'form-input special_deduct_flag']) ?>%</td>
        </tr>
        <tr>
            <td class="td-column">二级分润比例</td>
            <td class=""><?=Html::activeInput('text', $model, 'deduct_level2',['class'=>'form-input special_deduct_flag']) ?>%</td>
        </tr>
        <tr>
            <td class="td-column">三级分润比例</td>
            <td class=""><?=Html::activeInput('text', $model, 'deduct_level3',['class'=>'form-input special_deduct_flag']) ?>%</td>
        </tr>
        <tr>
            <td class="td-column">四级分润比例</td>
            <td class=""><?=Html::activeInput('text', $model, 'deduct_level4',['class'=>'form-input special_deduct_flag']) ?>%</td>
        </tr>
        </tbody>
    </table>
  </div>
    
    <script type="text/javascript">
        var modelisNew=<?=$model->isNewRecord?"true":"false"?>;
        
       function recePicFunc(pics){
           var c=$("#picfieldcontainer");
           for(var i=0;i<pics.length;i++){
               var h=$("#productPicTem").html();               
               h=h.replace(/pics\[\]/ig,pics[i]);
               h=h.replace(/{{index}}/ig,$("#picfieldcontainer .picwrap").length+i);
               c.append(h);               
           }
           $.unblockUI();
       }
       
       function deleteSignPic(id){
           $.get("<?=Url::to(['remove-pic'])?>",{productID:<?=Yii::$app->request->get('id',0)?>,picID:id},function(d){
               
                alert((d['error']?d['message']:"照片已经被立即删除"));
                
           },"json");
           
           return false;
       }
       
       $(function(){
           $("#picfieldcontainer").on('click','a',function(){
                var evn=$(this).attr("data-func");
                if(evn=="delete"){
                    $(this).parents("div.picwrap:first").find("#fengmian").appendTo(document.body);
                    $(this).parents("div.picwrap:first").remove();
                }
                if(evn=="setface"){
                    $("#fengmian").appendTo($(this).parents("div.picwrap:first")).show();
                    $("#faceField").val($(this).attr("data-face"));
                }
                return false;
            });
       });
    </script>
    <div id="tabsl-pic">
        <div style="width:80%;margin:20px auto;">
            
            <span id="fengmian">封面</span>
            <input type="hidden" id="faceField" name="faceField" value="">
            
            <div id="picfieldcontainer" class="clearfix">
                <?php                
                if(!empty($productPicModel)){
                    foreach($productPicModel as $item){ ?>
                        <div class="picwrap">                       
                        <img src='<?=Yii::getAlias('@web').$item['url']?>' class='productImg' />
                        <div style="position:absolute;left:150px;top:10px;">
                            <a href="#" data-func="delete" onclick="return deleteSignPic(<?=$item['id']?>);"><i class="icon-trash icon-large"></i> 删除</a>
                            <a href="#" data-func="setface" data-face="<?=$item['id']?>|old"><i class="icon-picture"></i> 设未封面</a>
                        </div>
                    </div>
                <?php    }} ?>
                <?php                
                if(!empty($productPicNewModel)){
                    foreach($productPicNewModel as $key => $item){ ?>
                        <div class="picwrap">                       
                        <input type='hidden' name='productPicNew[<?=$key?>][url]' value='<?=$item['url']?>'>
                        <img src='<?=$item['url']?>' class='productImg' />
                        <div style="position:absolute;left:150px;top:10px;">
                            <a href="#" data-func="delete"><i class="icon-trash icon-large"></i> 删除</a>
                            <a href="#" data-func="setface" data-face="<?=$key?>|new"><i class="icon-picture"></i> 设未封面</a>
                        </div>
                    </div>
                <?php    }} ?>
                
            </div>
            <a href="#" data-mydialog-target="#picdialog" class="mydialog-trigger btn btn_large"><i class=" icon-folder-open"></i>&nbsp;上传图片</a>
            
            <?php MyDialogWidget::begin(['id'=>'picdialog','title'=>'上传产品图片']);?>
            <div style="height:450px;overflow:hidden">
                <iframe id="frm_pic_dialog" style="border:0px solid #fff;width:100%;height:100%;" src="<?=Url::to(['/admin/upload'])?>" frameborder="0"></iframe>    
            </div>
            <?php MyDialogWidget::end();?>
            
            <p>说明：</p>            
            <ul>
                <li>上传的文件不能超过1M的大小</li>
                <li>图像的文件格式是jpg,png格式的图片</li>
            </ul>
        </div>
        
        
        
    </div>
    
</div> 
        
<p class="center">
     <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn_large' : 'btn btn_large btn-primary ']) ?>
</p>
 <?php ActiveForm::end(); ?>

<?php MyDialogWidget::begin(['id'=>'mw1','title'=>'选中产品类别']);?>
<div id="treeDemo" class="ztree" style="height:300px;overflow:auto"></div>
<div style="text-align:center;">
    <a href="javascript:getProductType();" class="btn">确 定</a>
    <a href="#" class="btn btn_gray unblockui-trigger">取 消</a>
</div>
<?php MyDialogWidget::end();?>
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

    
        treeobj=$.fn.zTree.init($("#treeDemo"), setting);
    });
    
    function getProductType(){
        var c=treeobj.getSelectedNodes();
        if(c.length>0){
            $("#product-type_id").val(c[0]['id']);
            $("#productTypeText").val(c[0]['name']);
            $.unblockUI();
        }
        
    }
</script>

<div id="productPicTem" class="hidden">
    <div class="picwrap">        
        <input type='hidden' name='productPicNew[{{index}}][url]' value='pics[]'>
        <img src='pics[]' class='productImg' />
        <div style="position:absolute;left:150px;top:10px;">
            <a href="#" data-func="delete"><i class="icon-trash icon-large"></i> 删除</a>
            <a href="#" data-func="setface" data-face="{{index}}|new"><i class="icon-picture"></i> 设未封面</a>
        </div>
    </div>
</div>