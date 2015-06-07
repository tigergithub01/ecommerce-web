<?php

namespace app\models\order;

use Yii;

/**
 * This is the model class for table "t_so_invoice".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $invoice_type
 * @property string $invoice_header
 */
class SoInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_so_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'invoice_type', 'invoice_header'], 'required'],
            [['order_id', 'invoice_type'], 'integer'],
            [['invoice_header'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'order_id' => '关联订单编号',
            'invoice_type' => '发票类型',
            'invoice_header' => '发票抬头',
        ];
    }
}
