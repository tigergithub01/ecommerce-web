<?php

namespace app\models\finance;

use Yii;

/**
 * This is the model class for table "t_vip_withdraw_flow".
 *
 * @property integer $id
 * @property integer $sheet_type_id
 * @property string $code
 * @property string $apply_date
 * @property integer $vip_id
 * @property string $amount
 * @property string $settled_amt
 * @property string $settled_date
 * @property integer $status
 */
class VipWithdrawFlow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_vip_withdraw_flow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sheet_type_id', 'code', 'apply_date', 'vip_id', 'status'], 'required'],
            [['sheet_type_id', 'vip_id', 'status'], 'integer'],
            [['apply_date', 'settled_date'], 'safe'],
            [['amount', 'settled_amt'], 'number'],
            [['code'], 'string', 'max' => 30]
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
            'code' => '提现申请编号(根据单据编号自动生成）',
            'apply_date' => '申请日期',
            'vip_id' => '申请会员编号',
            'amount' => '申请提现金额',
            'settled_amt' => '实际提现金额',
            'settled_date' => '结算时间',
            'status' => '提现申请状态（1:已结算、0：未结算）',
        ];
    }
    
    /* public function getStatusName(){
    	return ($this->status==1)?'已结算':'未结算';
    } */
}
