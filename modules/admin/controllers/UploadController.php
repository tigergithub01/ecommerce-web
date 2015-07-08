<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\UploadForm;
use yii\web\UploadedFile;

class UploadController extends Controller {

    public $enableCsrfValidation = false;

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
                'denyCallback' => function() {
            $this->redirect(['default/login']);
        }
            ],
        ];
    }

    public function actions() {
        
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionUpload() {
        
        // 1 minutes execution time
        @set_time_limit(1 * 60);

        //Uncomment this one to fake upload time
        //usleep(5000);

        // 保存目录
        $targetDir = Yii::getAlias('@webroot/upload/product') . DIRECTORY_SEPARATOR . date('Ymd');      
        //web目录
        $webDir = Yii::getAlias('@web/upload/product') . DIRECTORY_SEPARATOR . date('Ymd'); 
        $webDir= str_replace('\\','/',$webDir);
        
        //创建目录
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }
        
       if (empty($_FILES)) {
           echo json_encode(array('error'=>['code'=>'101','message'=>'空文件']));
       }       
       
        if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        }
            
        $ext=preg_replace('#.*(\\..+)$#', '$1', $_FILES["file"]['name']);                
        $file=date('YmdHms').rand(1000, 9999).$ext;

        $targetfile=$targetDir.DIRECTORY_SEPARATOR .$file;               

        if(move_uploaded_file($_FILES["file"]["tmp_name"],$targetfile)){
            //生成缩略图
            $th=new \app\components\Thumb();
            $th->scaleImage($targetfile,$targetfile,220);            
            $webpath=$webDir.'/'.$file;            
            echo json_encode(array('data'=>$webpath));            
        }else{
            die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        }
        
    }

}
