<?php

namespace app\models\basic;

use Yii;

/**
 * This is the model class for table "t_bank_info".
 *
 * @property integer $id
 * @property string $name
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
            [['name','type_id','id','pa_val'], 'required'],
            [['id', 'type_id', 'seq_id'], 'integer'],
            [['id'], 'unique','message'=>'{value}ID必须唯一']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id'=>'所属参数类型编号',
            'pa_val' => '参数值',
            'description' => '描述',
            'seq_id' => '序号，用来显示的时候排序用',
        ];
    }
}
