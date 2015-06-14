<?php

namespace app\models;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{    
    /**
     * @inheritdoc
     */
    public static function tableName(){
        return "t_user";
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user=  static::findOne(['id'=>$id]);
        return $user?$user:null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user=static::findOne(['accessToken'=>$token]);
        return $user?$user:null;       
    }

    /**
     * Finds user by username
     *
     * @param  string      $user_id
     * @return static|null
     */
    public static function findByUserId($user_id)
    {
        $user=  static::findOne(['user_id'=>  $user_id]);        
        return $user?$user:null; 
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {        
        return $this->password === $password;
    }
}
