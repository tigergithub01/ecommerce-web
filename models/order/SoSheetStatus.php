<?php

namespace app\models\order;

use Yii;


class SoSheetStatus extends \yii\db\ActiveRecord
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
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'type_id' => '参数类型',
            'pa_val' => '订单状态',
            'description' => '描述',
            'seq_id' => '序号',           
        ];
    }    
  
}
