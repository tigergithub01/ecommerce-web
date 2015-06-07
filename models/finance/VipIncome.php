<?php

namespace app\models\finance;

use Yii;

/**
 * This is the model class for table "t_vip_income".
 *
 * @property integer $id
 * @property integer $vip_id
 * @property string $amount
 * @property string $can_settle_amt
 * @property string $settled_amt
 */
class VipIncome extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_vip_income';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_id'], 'required'],
            [['vip_id'], 'integer'],
            [['amount', 'can_settle_amt', 'settled_amt'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'vip_id' => '关联会员编号',
            'amount' => '累计收入金额',
            'can_settle_amt' => '可结算金额',
            'settled_amt' => '已结算金额',
        ];
    }
}
