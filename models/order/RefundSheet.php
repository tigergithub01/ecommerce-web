<?php

namespace app\models\order;

use Yii;
use app\models\basic\Parameter;
use app\models\order\ReturnSheet;
/**
 * This is the model class for table "t_refund_sheet".
 *
 * @property integer $id
 * @property integer $sheet_type_id
 * @property string $code
 * @property integer $order_id
 * @property integer $return_id
 * @property integer $user_id
 * @property string $sheet_date
 * @property string $need_return_amt
 * @property string $return_amt
 * @property string $memo
 * @property integer $status
 * @property integer $settle_flag
 */
class RefundSheet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_refund_sheet';
    }
    
    public static function settleFlagArray(){
        return [0=>'未结算',1=>'已结算'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sheet_type_id', 'code', 'order_id', 'user_id', 'sheet_date', 'status', 'settle_flag'], 'required'],
            [['sheet_type_id', 'order_id', 'return_id', 'user_id', 'status', 'settle_flag'], 'integer'],
            [['sheet_date'], 'safe'],
            [['need_return_amt', 'return_amt'], 'number'],
            [['code'], 'string', 'max' => 30],
            [['memo'], 'string', 'max' => 400]
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
            'code' => '退款单编号（根据单据规则自动生成）',
            'order_id' => '关联订单编号',
            'return_id' => '关联退货单编号',
            'user_id' => '制单人',
            'sheet_date' => '制单时间',
            'need_return_amt' => '待退款金额',
            'return_amt' => '实际退款金额',
            'memo' => '备注',
            'status' => '退款单状态（待退款、已退款）',
            'settle_flag' => '结算状态（未结算、已结算）',
        ];
    }
    
    public function getStatusData(){
        return $this->hasOne(Parameter::className(), ['id'=>'status']);
    }
    
    public function getSettleFlagTxt(){
        $c= self::settleFlagArray();
        if(key_exists($this->settle_flag, $c)){
            return $c[$this->settle_flag];
        }else{
            return "";
        }
    }
    
    /***
     * 关联的退货单
     */
    public function getAssociateReturnSheet(){
        return ReturnSheet::find()->where(['order_id'=>$this->order_id])->all();
    }
}
