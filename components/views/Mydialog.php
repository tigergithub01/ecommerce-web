<?php
    use yii\helpers\Html;

    
    \app\assets\BlockUIAsset::register($this);    
  
?>
<script type="text/javascript">

</script>

<div id="<?=$id?>" class="mydialog">
    <div class="mydialog-title clearfix">
        <a href="javascript:void(0);" class="mydialog-close unblockui-trigger" title="关闭窗口"></a>
        <?=Html::encode($title)?>        
    </div>
    
    <div class="mydialog-content">
        <?=$content?>
    </div>
    
</div>
