<?php
use yii\helpers\Html;
use yii\helpers\Url;
app\assets\PluploadAsset::register($this,  \yii\web\View::POS_HEAD);
?>

<h1>Custom example</h1>

<p>Shows you how to use the core plupload API.</p>

<div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
<br />

<div id="container">
    <a id="pickfiles" href="javascript:;">[Select files]</a> 
    <a id="uploadfiles" href="javascript:;">[Upload files]</a>
</div>

<br />
<pre id="console"></pre>


<script type="text/javascript">
// Custom example logic
$(function(){
var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass an id...
	container: document.getElementById('container'), // ... or DOM Element itself
	url : '<?=Url::to(['upload'])?>',
        flash_swf_url : '<?=Yii::getAlias('@web') ?>/js/plupload/Moxie.swf',
        silverlight_xap_url : '<?=Yii::getAlias('@web') ?>/js/plupload/Moxie.xap',
	filters : {
		max_file_size : '10mb',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Zip files", extensions : "zip"}
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('filelist').innerHTML = '';

			document.getElementById('uploadfiles').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},

		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
		}
	}
});

uploader.init();
});
</script>