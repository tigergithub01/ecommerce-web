<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_role_rights".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $module_id
 * @property integer $op_id
 */
class RoleRights extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_role_rights';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'module_id', 'op_id'], 'required'],
            [['role_id', 'module_id', 'op_id'], 'integer']
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
            'module_id' => '关联模块编号',
            'op_id' => '关联操作编号',
        ];
    }
}
