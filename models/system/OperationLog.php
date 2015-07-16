<?php

namespace app\models\system;

use Yii;
use yii\data\SqlDataProvider;
/**
 * This is the model class for table "t_operation_log".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $module_id
 * @property integer $operation_id
 * @property string $op_date
 * @property string $op_ip_addr
 * @property string $op_browser_type
 * @property string $op_url
 * @property string $op_desc
 */
class OperationLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_operation_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'module_id', 'operation_id', 'op_date'], 'required'],
            [['user_id', 'module_id', 'operation_id'], 'integer'],
            [['op_date'], 'safe'],
            [['op_desc'], 'string'],
            [['op_ip_addr'], 'string', 'max' => 30],
            [['op_browser_type'], 'string', 'max' => 60],
            [['op_url'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'user_id' => '关联用户编号',
            'module_id' => '关联模块编号',
            'operation_id' => '关联操作编号',
            'op_date' => '操作日期',
            'op_ip_addr' => '操作IP地址',
            'op_browser_type' => '浏览器类型',
            'op_url' => '操作对应完整URL',
            'op_desc' => '操作描述',
        ];
    }
    
    public static function getList($params){
        $sql="select a.*,b.user_id,b.user_name,c.code as module_code,c.name as module_name,d.name as operation_name,d.code as operation_code from "
                ." t_operation_log a left join t_user b on a.user_id=b.id"
                ." left join t_module c on a.module_id=c.id"
                ." left join t_operation d on a.operation_id=d.id";
        
        $countSql="select count(*) as num from t_operation_log a";
        $count= Yii::$app->db->createCommand($countSql,$params)->queryScalar();
        
        $provider = new SqlDataProvider([
            'sql' => $sql,
            'params' => $params,
            'totalCount' => intval($count),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort'=>[
                'attributes'=>['a.id'=>SORT_DESC],
            ],
        ]);
        
        return $provider;
    }
    
    public static function  addLog($log){
        $log=new OperationLog();
    }
}
