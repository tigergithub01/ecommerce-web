<?php

namespace app\models\basic;

use Yii;

/**
 * This is the model class for table "t_delivery_type".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $print_tpl
 * @property string $description
 * @property integer $status
 */
class DeliveryType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_delivery_type';
    }
    
    public static function StatusType(){
        return array(0=>'无效',1=>'有效');
    }
    
    public function getStatusText(){
        if(key_exists($this->status, self::StatusType())){
            return self::StatusType()[$this->status];
        }else{
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'status'], 'required'],
            [['print_tpl'], 'string'],
            [['status'], 'integer'],
            [['code'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 60],
            [['description'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'code' => '配送方式唯一编码',
            'name' => '配送方式名称',
            'print_tpl' => '打印模板',
            'description' => '描述',
            'status' => '状态(1:有效；0:停用)',
        ];
    }
}
