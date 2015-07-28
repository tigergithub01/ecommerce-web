<?php

namespace app\models\system;

use Yii;
use yii\data\SqlDataProvider;
/**
 * 后台操作日志
 *
 */
class AdminOperationLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_admin_operation_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'op_date'], 'required'],
            [['user_id',], 'integer'],
            [['op_date'], 'safe'],
            [['op_desc','op_date','controller','action'], 'string'],
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
            'controller' => '控制器',
            'action' => '动作',
            'op_data' => '内容',
            'op_date' => '操作日期',
            'op_ip_addr' => '操作IP地址',
            'op_browser_type' => '浏览器类型',
            'op_url' => '操作对应完整URL',
            'op_desc' => '操作描述',
        ];
    }
    
    public static function getList($params){
        $sql="select a.*,b.user_id,b.user_name from  t_admin_operation_log a left join t_user b on a.user_id=b.id order by a.id desc";
        
        $countSql="select count(*) as num from t_admin_operation_log a";
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
   
}
