<?php

namespace app\modules\sale\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\modules\sale\models\VipForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\system\AppInfo;
use app\models\system\AppRelease;
use app\modules\sale\models\SaleConstants;

class DownloadAppController extends \yii\web\Controller {
	public function actionIndex() {
		return $this->render ( 'index' );
	}
	
	public function actionAndroid() {
		//android app id 
		$app_android_id = 1;
		$file_name = null;
		
		//get application information
		$appInfo = AppInfo::findOne ( $app_android_id );
		if (! empty ( $appInfo->release_id )) {
			$appRelease = AppRelease::findOne ( $appInfo->release_id );
			$file_name = $appRelease->app_path;
		}
		
		header ( "Content-type:text/html;charset=utf-8" );
		// 用以解决中文不能显示出来的问题
		$file_name = iconv ( "utf-8", "gb2312", $file_name );
		$file_sub_path = $_SERVER ['DOCUMENT_ROOT'] . '/' . SaleConstants::$app_path;
		$file_path = $file_sub_path . $file_name;
		echo $file_path;
		// 首先要判断给定的文件存在与否
		if (! file_exists ( $file_path )) {
			echo "您要下载的文件不存在。";
			return;
		}
		$fp = fopen ( $file_path, "r" );
		$file_size = filesize ( $file_path );
		// 下载文件需要用到的头
		Header ( "Content-type: application/octet-stream" );
		Header ( "Accept-Ranges: bytes" );
		Header ( "Accept-Length:" . $file_size );
		Header ( "Content-Disposition: attachment; filename=" . $file_name );
		$buffer = 1024;
		$file_count = 0;
		// 向浏览器返回数据
		while ( ! feof ( $fp ) && $file_count < $file_size ) {
			$file_con = fread ( $fp, $buffer );
			$file_count += $buffer;
			echo $file_con;
		}
		fclose ( $fp );
	}
}
