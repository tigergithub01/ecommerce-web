<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class AdminLoginForm extends Model
{
    public $userId;
    public $password;
    public $rememberMe = false;
    public $verifyCode;
    
    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {       
        return [
            // username and password are both required
            [['userId', 'password','verifyCode'], 'required','message'=>'{attribute}不能为空'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],          
            ['verifyCode', 'captcha','captchaAction'=>'admin/default/captcha'],
        ];
    }
    public function attributeLabels() {
        $c=parent::attributes();
        $c['userId']='账号';
        $c['password']='密码';
        $c['rememberMe']='一周内不用登陆';
        $c['verifyCode']='验证码';
        return $c;
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

            if (!$user || !$user->validatePassword(md5($this->password))) {
                $this->addError($attribute, '无效的用户名或密码');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {       
        if ($this->validate()) {            
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUserId($this->userId);
        }

        return $this->_user;
    }
}