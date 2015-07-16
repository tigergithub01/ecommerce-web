<?php

namespace app\models\system;

use Yii;
use app\models\vip\Vip;
/**
 * This is the model class for table "t_sys_feedback".
 *
 * @property integer $id
 * @property integer $vip_id
 * @property string $feedback_date
 * @property string $feedback_type
 * @property string $content
 * @property string $ip_address
 * @property string $os_type
 * @property string $phone_model
 * @property string $contact_method
 */
class SysFeedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_sys_feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_id'], 'integer'],
            [['feedback_date', 'content', 'ip_address'], 'required'],
            [['feedback_date'], 'safe'],
            [['feedback_type', 'os_type','contact_method'], 'string', 'max' => 100],
            [['content'], 'string', 'max' => 500],
            [['ip_address'], 'string', 'max' => 30],
            [['phone_model'], 'string', 'max' => 60],
        	[['contact_method'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'vip_id' => '会员编号',
            'feedback_date' => '反馈时间',
            'feedback_type' => '反馈类型',
            'content' => '反馈内容',
            'ip_address' => 'IP地址',
            'os_type' => '操作系统',
            'phone_model' => '手机型号',
        	'contact_method' => '联系方式，邮箱或电话',
        ];
    }
    
    public function getVip(){
       return $this->hasOne(Vip::className(), ['id'=>'vip_id']);
    }
}
