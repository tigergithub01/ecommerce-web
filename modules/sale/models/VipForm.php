<?php

namespace app\modules\sale\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class VipForm extends Model
{
    public $vip_no;
    public $password;
    public $parent_vip_no;
    public $verifyCode;
//     public $rememberMe = true;


    public function scenarios()
    {
    	return [
    			'login' => ['vip_no', 'password'],
    			'register' => ['vip_no', 'password', 'parent_vip_no','verifyCode'],
    	];
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['vip_no', 'password','parent_vip_no','verifyCode'], 'required'],
        	[['password'], 'string','min'=>6, 'max' => 16,'on' => ['register']],
        	[['vip_no','parent_vip_no'],'match','pattern'=>'/^1[0-9]{10}$/','message'=>'{attribute}必须为1开头的11位纯数字'],
            // rememberMe must be a boolean value
//             ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
//             ['password', 'validatePassword'],
        ];
    }
    
    public function attributeLabels()
    {
    	return [
    			'vip_no' => '会员手机号码',
    			'password' => '密码',
    			'verifyCode' => '手机验证码',
    			'parent_vip_no' => '推荐人手机号码',
    	];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        /*
    	if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        } else {
            return false;
        }
        */
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        /*
    	if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
        */
    }
}
