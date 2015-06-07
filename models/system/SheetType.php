<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_sheet_type".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $prefix
 * @property string $date_format
 * @property string $sep
 * @property integer $seq_length
 * @property integer $cur_seq
 */
class SheetType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_sheet_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'code', 'name', 'prefix', 'date_format', 'seq_length', 'cur_seq'], 'required'],
            [['id', 'seq_length', 'cur_seq'], 'integer'],
            [['code', 'prefix', 'sep'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 60],
            [['date_format'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'code' => '单据唯一编码',
            'name' => '单据名称',
            'prefix' => '单据前缀',
            'date_format' => '日期格式(yyyyMMdd)',
            'sep' => '分隔符(Null、’-’)',
            'seq_length' => '序列长度',
            'cur_seq' => '当前序列号',
        ];
    }
}
