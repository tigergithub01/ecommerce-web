<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_role_user".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $user_id
 */
class RoleUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_role_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'user_id'], 'required'],
            [['role_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'role_id' => '关联角色编号',
            'user_id' => '关联用户编号',
        ];
    }
}
