<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_role".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 60],
            [['description'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'name' => '角色名称',
            'description' => '描述',
        ];
    }
}
