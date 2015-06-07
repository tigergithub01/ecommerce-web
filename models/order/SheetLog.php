<?php

namespace app\models\order;

use Yii;

/**
 * This is the model class for table "t_sheet_log".
 *
 * @property integer $id
 * @property integer $sheet_type_id
 * @property integer $ref_sheet_id
 * @property integer $user_id
 * @property integer $vip_id
 * @property string $operate_date
 * @property string $memo
 */
class SheetLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_sheet_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sheet_type_id', 'ref_sheet_id', 'operate_date'], 'required'],
            [['sheet_type_id', 'ref_sheet_id', 'user_id', 'vip_id'], 'integer'],
            [['operate_date'], 'safe'],
            [['memo'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'sheet_type_id' => '单据类型（订单、发货单、退货单、退款单）',
            'ref_sheet_id' => '关联单据编号',
            'user_id' => '关联操作用户编号',
            'vip_id' => '关联操作会员编号',
            'operate_date' => '操作时间',
            'memo' => '备注',
        ];
    }
}
