<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_phone_verify_code".
 *
 * @property integer $id
 * @property integer $code_type
 * @property string $phone_number
 * @property string $sent_time
 * @property string $expiration_time
 * @property string $verify_code
 * @property string $sms_content
 * 
 */
class PhoneVerifyCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_phone_verify_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code_type'], 'integer'],
            [['phone_number','sent_time', 'verify_code'], 'required'],
            [['sent_time', 'expiration_time'], 'safe'],
            [['verify_code'], 'string', 'max' => 10],
            [['sms_content'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'code_type' => '验证码用途类型（注册、找回密码）',
        	'phone_number' => '手机号码',
            'sent_time' => '发送时间',
            'expiration_time' => '过期时间',
            'verify_code' => '验证码',
            'sms_content' => '手机短信内容',
        ];
    }
}
