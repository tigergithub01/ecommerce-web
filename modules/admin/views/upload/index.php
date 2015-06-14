<?php
use yii\helpers\Html;
use yii\helpers\Url;
app\assets\PluploadAsset::register($this,  \yii\web\View::POS_HEAD);
?>

<style type="text/css">
    .fld{ height: 30px;line-height:30px;background-color:#f5f7f8;padding:0px 15px;}
    #piclist img { width:80px;margin:10px;}
</style>

<div class="clearfix h1div">
        <div class="float-right" id="container">            
            <a id="pickfiles" href="javascript:;" class="button_link">选择文件</a> 
            <a id="uploadfiles" href="javascript:;" class="button_link">上 传</a>
        </div>        
        <strong class="title">上传产品图片</strong>
    </div>

<div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.
   
</div>
<div id="piclist">    
<!--<img src="/web/upload/product/20150611/201506112106487408.jpg"><img src="/web/upload/product/20150611/201506112106493821.jpg"><img src="/web/upload/product/20150611/201506112106502809.jpg"><img src="/web/upload/product/20150611/201506112106521411.jpg"><img src="/web/upload/product/20150611/201506112106535197.jpg">-->
</div>
<br />
<p class="center hidden" id="submit_pic">
   <a  href="javascript:getPicReturn();" class="btn btn_large ">确  定</a>  
</p>

<br />
<pre id="console"></pre>


<script type="text/javascript">
    var picArray=[];
    
    function getPicReturn(){
        var pwin=self.parent || self.opener;        
        if(pwin.recePicFunc && typeof(pwin.recePicFunc)=="function"){
            pwin.recePicFunc(picArray);
        }
    }
// Custom example logic
$(function(){
    var uploader = new plupload.Uploader({
            //chunk_size:"200kb",
            runtimes : 'html5,silverlight,flash,html4',
            browse_button : 'pickfiles', // you can pass an id...
            container: document.getElementById('container'), // ... or DOM Element itself
            url : '<?=Url::to(['upload'])?>',
            flash_swf_url : '<?=Yii::getAlias('@web') ?>/js/plupload/Moxie.swf',
            silverlight_xap_url : '<?=Yii::getAlias('@web') ?>/js/plupload/Moxie.xap',
            unique_names:true,            
            filters : {
                    max_file_size : '1mb',
                    mime_types: [
                            {title : "Image files", extensions : "jpg,png"}                            
                    ]
            },

            init: {
                    PostInit: function() {
                            $('#filelist').html('');
                         
                            $('#uploadfiles').click(function() {
                                    uploader.start();
                                    return false;
                            });
                    },

                    FilesAdded: function(up, files) {
                            plupload.each(files, function(file) {
                                    $('#filelist').append('<div class="fld" id="' + file.id + '">' + file.name + ' (<b>' + plupload.formatSize(file.size) + ' </b>)</div>');
                            });
                    },

                    UploadProgress: function(up, file) {                         
                        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                    },
                    BeforeUpload:function(up,file){
                        $("#"+file.id).find('b').html('<span>上传中...</span>');
                    },
                    FileUploaded:function(up,file,resp){
                        if(resp["status"]==200){
                            var d=eval("("+resp.response+")");                            
                            $("#piclist").append("<img src='"+d["data"]+"'>");
                            picArray.push(d['data']);
                        }
                    },
                    UploadComplete:function(up,files){
                        alert("文件上传完毕");                     
                        $("#submit_pic").show();
                    },
                    Error: function(up, err) {
                        alert("文件："+err.file.name+"无效,原因："+err.message);
                        document.getElementById('console').appendChild(document.createTextNode("\n" +err.file.name+'：' + err.message));
                    }
            }
    });
  
    uploader.init();
});
</script>
