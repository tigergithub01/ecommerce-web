<?php

namespace app\models\order;

use Yii;

/**
 * This is the model class for table "t_return_sheet".
 *
 * @property integer $id
 * @property integer $sheet_type_id
 * @property string $code
 * @property integer $order_id
 * @property integer $out_id
 * @property integer $user_id
 * @property string $sheet_date
 * @property string $return_amt
 * @property string $memo
 * @property integer $status
 */
class ReturnSheet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_return_sheet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sheet_type_id', 'code', 'order_id', 'out_id', 'user_id', 'sheet_date', 'status'], 'required'],
            [['sheet_type_id', 'order_id', 'out_id', 'user_id', 'status'], 'integer'],
            [['sheet_date'], 'safe'],
            [['return_amt'], 'number'],
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
            'code' => '退货单编号（根据单据规则自动生成）',
            'order_id' => '关联订单编号',
            'out_id' => '关联发货单编号',
            'user_id' => '制单人',
            'sheet_date' => '制单时间',
            'return_amt' => '待退货金额',
            'memo' => '备注',
            'status' => '退货单状态（待退货、已完成）',
        ];
    }
}
