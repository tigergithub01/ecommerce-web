<?php

namespace app\models\order;

use Yii;

/**
 * This is the model class for table "t_return_detail".
 *
 * @property integer $id
 * @property integer $return_id
 * @property integer $product_id
 * @property string $out_quantity
 * @property string $return_quantity
 */
class ReturnDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_return_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['return_id', 'product_id'], 'required'],
            [['return_id', 'product_id'], 'integer'],
            [['out_quantity', 'return_quantity'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'return_id' => '关联退货单编号',
            'product_id' => '关联产品编号',
            'out_quantity' => '发货数量',
            'return_quantity' => '本次退货数量',
        ];
    }
}
