<?php

namespace app\models\order;

use Yii;
use app\models\basic\Parameter;
use app\models\basic\DeliveryType;

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
            'user_id' => '制单人id',
            'sheet_date' => '制单时间',
            'deliver_fee' => '运费',
            'delivery_no' => '快递单号',
            'memo' => '备注',
            'status' => '发货单状态（配货中、已发货）',
        ];
    }
    
    public function getStatusData(){
        return $this->hasOne(Parameter::className(), ['id'=>'status']);
    }
    public function getProducts(){
        $sql="select b.*,a.name as productName "
                ."from t_product a left join t_so_detail b on a.id=b.product_id where b.order_id=:id";
        
        $comm=\Yii::$app->db->createCommand($sql);
        $comm->bindValue(':id',$this->order_id);
        return $comm->queryAll();
    }
    
    public function getSheetDetailProducts(){
         $sql="select b.*,a.name as productName "
                ."from t_product a left join t_out_stock_detail b on a.id=b.product_id where b.out_id=:out_id";
        
        $comm=\Yii::$app->db->createCommand($sql);
        $comm->bindValue(':out_id',$this->id);
        return $comm->queryAll();
    }
    
    public function getDetial1(){
        $conn=Yii::$app->db;
        $sql="select a.*,b.name as productName from t_out_stock_detail a inner join  t_product b on a.product_id=b.id "             
                ."where a.out_id=:out_id";
        return $conn->createCommand($sql)->bindValue(':out_id', $this->id)->queryAll();
    }
    
    public static function updateStatus($id,$status){
        $sql="update t_out_stock_sheet set status=:status where id=:id";
        Yii::$app->db->createCommand($sql,[':status'=>$status,':id'=>$id])->execute();
    }
    
    public function getDeliveryInfo(){
        return $this->hasOne(DeliveryType::className(), ['id'=>'delivery_type']);
    }
    
    
}
