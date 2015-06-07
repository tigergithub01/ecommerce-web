<?php

namespace app\models\order;

use Yii;

/**
 * This is the model class for table "t_out_stock_sheet".
 *
 * @property integer $id
 * @property integer $sheet_type_id
 * @property string $code
 * @property integer $order_id
 * @property integer $user_id
 * @property string $sheet_date
 * @property string $deliver_fee
 * @property string $memo
 * @property integer $status
 */
class OutStockSheet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_out_stock_sheet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sheet_type_id', 'code', 'order_id', 'user_id', 'sheet_date', 'status'], 'required'],
            [['sheet_type_id', 'order_id', 'user_id', 'status'], 'integer'],
            [['sheet_date'], 'safe'],
            [['deliver_fee'], 'number'],
            [['code'], 'string', 'max' => 30],
            [['memo'], 'string', 'max' => 400],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'sheet_type_id' => '单据类型',
            'code' => '发货单编号（根据规则自动生成）',
            'order_id' => '关联订单编号',
            'user_id' => '制单人',
            'sheet_date' => '制单时间',
            'deliver_fee' => '运费',
            'memo' => '备注',
            'status' => '发货单状态（配货中、已发货）',
        ];
    }
}
