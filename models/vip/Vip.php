<?php

namespace app\models\vip;

use Yii;

/**
 * This is the model class for table "t_vip".
 *
 * @property integer $id
 * @property string $vip_no
 * @property string $name
 * @property string $id_card
 * @property string $last_login_date
 * @property string $password
 * @property integer $parent_id
 * @property string $email
 * @property integer $email_verify_flag
 * @property integer $status
 * @property string $register_date
 */
class Vip extends \yii\db\ActiveRecord
{
    
	//transient fields
    public $parent_vip_no;
    
    public $level;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_vip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_no', 'password', 'status', 'register_date'], 'required'],
            [['last_login_date', 'register_date'], 'safe'],
            [['parent_id', 'email_verify_flag', 'status'], 'integer'],
            [['vip_no', 'id_card'], 'string', 'max' => 30],
            [['name', 'password'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 60],
            [['vip_no'], 'unique','message'=>'{value}已经被注册过了']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'vip_no' => '会员手机号码',
            'name' => '姓名',
            'id_card' => '身份证',
            'last_login_date' => '最后一次登陆时间',
            'password' => '密码',
            'parent_id' => '上级会员编号',
            'email' => '安全邮箱',
            'email_verify_flag' => '安全邮箱是否已验证(1:是；0：否)',
            'status' => '会员状态(1:正常、0:停用)',
            'register_date' => '注册时间',
        	'parent_vip_no' => '推荐人手机号码',
        ];
    }
}
