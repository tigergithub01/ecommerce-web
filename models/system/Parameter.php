<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_parameter".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $pa_val
 * @property string $description
 */
class Parameter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_parameter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'pa_val'], 'required'],
            [['id', 'type_id'], 'integer'],
            [['pa_val'], 'string', 'max' => 60],
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
            'type_id' => '所属参数类型编号',
            'pa_val' => '参数值',
            'description' => '描述',
        ];
    }
}
