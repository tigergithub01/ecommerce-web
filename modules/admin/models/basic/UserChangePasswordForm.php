<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\modules\admin\models\basic;
use app\models\basic\User;

class UserChangePasswordForm extends \yii\base\Model
{    
    public $id;
    public $oldPassword;
    public $newPassword;
    public $confirmPassword;
    
    public function attributeLabels()
    {
        return [
            'oldPassword' => '旧密码',
            'newPassword' => '密码',
            'confirmPassword' => '确认密码',          
        ];
    }
    
    public function rules(){
        return [            
            [['oldPassword','newPassword','confirmPassword'],'required','message'=>'{attribute}不能为空'],
            ['confirmPassword','compare','compareAttribute'=>'newPassword','message'=>'两次输入的密码不一致'],
            ['id','checkUserExists'],
            ['oldPassword','checkOldPassword'],
        ];
    }
    
    public function checkUserExists($attribute, $params){
        $id=User::find()->select('id')->where(['id'=>$this->$attribute])->scalar();
        if(!$id){
            $this->addError('id', '无效的用户');
        }
    }
    
    public function checkOldPassword($attribute, $params){
        $id=User::find()->select('id')->where(['id'=>$this->id,'password'=>md5($this->oldPassword)])->scalar();
        if(!$id){
            $this->addError('oldPassword', '旧密码不正确');
        }
    }
    
    public function save(){
        $model = User::findOne($this->id);     
        $model['password']=md5($this->newPassword);        
        $model['update_user_id']=\Yii::$app->user->identity->id;
        $model['update_date']=date(\Yii::$app->params['date_format'],time());
        
        return $model->save();
    }
    
    
    
  
    
}
