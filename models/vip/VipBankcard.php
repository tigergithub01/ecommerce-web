<?php

namespace app\models\vip;

use Yii;
use app\models\basic\BankInfo;

/**
 * This is the model class for table "t_vip_bankcard".
 *
 * @property integer $id
 * @property integer $vip_id
 * @property string $card_no
 * @property integer $bank_id
 * @property string $branch_name
 * @property string $open_addr
 */
class VipBankcard extends \yii\db\ActiveRecord
{
    
    //transite fields;
    public $bank_name;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_vip_bankcard';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_id', 'card_no', 'bank_id', 'branch_name', 'open_addr'], 'required'],
            [['vip_id', 'bank_id'], 'integer'],
            [['card_no'], 'string', 'max' => 60],
            [['branch_name', 'open_addr'], 'string', 'max' => 100],
        	[['card_no'],'match','pattern'=>'/^(\d{16}|\d{19})$/','message'=>'{attribute}是16位或者19位数字'],
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
            'card_no' => '银行卡号',
            'bank_id' => '所属银行编号',
            'branch_name' => '支行',
            'open_addr' => '开户地',
        ];
    }
    
    public function getBankInfo(){
        return $this->hasOne(BankInfo::className(), ['id'=>'bank_id']);
    }
}
