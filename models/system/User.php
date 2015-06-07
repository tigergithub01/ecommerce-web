<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_user".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $user_name
 * @property string $password
 * @property integer $status
 * @property string $last_login_date
 * @property integer $create_user_id
 * @property string $create_date
 * @property integer $update_user_id
 * @property string $update_date
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'password', 'status'], 'required'],
            [['status', 'create_user_id', 'update_user_id'], 'integer'],
            [['last_login_date', 'create_date', 'update_date'], 'safe'],
            [['user_id'], 'string', 'max' => 20],
            [['user_name'], 'string', 'max' => 60],
            [['password'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'user_id' => '登陆名，手机号码',
            'user_name' => '姓名',
            'password' => '密码',
            'status' => '状态（1：有效、0：停用）',
            'last_login_date' => '最后一次登陆时间',
            'create_user_id' => '创建人',
            'create_date' => '创建日期',
            'update_user_id' => '更新日期',
            'update_date' => '更新人',
        ];
    }
}
