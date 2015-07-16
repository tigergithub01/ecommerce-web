<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_ad_info".
 *
 * @property integer $id
 * @property string $image_url
 * @property integer $sequence_id
 * @property string $redirect_url
 */
class AdInfo extends \yii\db\ActiveRecord
{
    public $url;
    public $file;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_ad_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            [['image_url', 'sequence_id'], 'required'],           
            [['sequence_id'], 'integer'],
            [['redirect_url'], 'string', 'max' => 100],
            //[['file'],'file','maxSize'=>1024*1024,'extensions'=>'jpg,jpeg,png'],
            [['file'],'filecheck'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'image_url' => '图片地址',
            'sequence_id' => '显示顺序',
            'redirect_url' => '点击后跳转关联URL',
        ];
    }
    
    public function filecheck($attribute){
               
        if($this->file->error>0){
            $msg="";
            switch ($this->file->error){
                case UPLOAD_ERR_INI_SIZE:
                    $msg="文件太大";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $msg="上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $msg="文件只有部分被上传";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $msg="没有文件被上传";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $msg="找不到临时文件夹";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $msg="文件写入失败";
                    break;
            }
            $this->addError($attribute,"上传错误,错误代码：".$msg);
            return;
        }
        
        if(!is_uploaded_file($this->file->tempName)){
            $this->addError($attribute,"无效的上传图片文件");
            return;
        }
       
        if($this->file->size>1024*1024){
            $this->addError($attribute,"文件太大了，不能超过1M");
            return;
        }
        
        if($this->file->size==0){
            $this->addError($attribute,"无效的文件");
            return;
        }
        
        if(!in_array($this->file->type,array('image/png','image/jpeg','image/gif','image/bmp')) ){
            $this->addError($attribute,"无效的图片类型，只能上传jpg,png,gif,bmp格式的文件");
            return;
        }
        
    }
}
