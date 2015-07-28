<?php

namespace app\models\basic;

use Yii;
use app\models\system\Role;
/**
 * This is the model class for table "t_user".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $user_name
 * @property string $password
 * @property integer $status
 * @property string $last_login_date
 * @property integer $create_user_id
 * @property string $create_date
 * @property integer $update_user_id
 * @property string $update_date
 *
 * @property TOperationLog[] $tOperationLogs
 * @property TOutStockSheet[] $tOutStockSheets
 * @property TRefundSheet[] $tRefundSheets
 * @property TReturnSheet[] $tReturnSheets
 * @property TRoleUser[] $tRoleUsers
 * @property TSheetLog[] $tSheetLogs
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'password', 'status'], 'required'],
            [['user_id'], 'unique'],
            [['status', 'create_user_id', 'update_user_id'], 'integer'],
            [['last_login_date', 'create_date', 'update_date'], 'safe'],
            [['user_id'], 'string', 'max' => 20],
            [['user_name'], 'string', 'max' => 60],
            [['password'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'user_id' => '登陆名',
            'user_name' => '姓名',
            'password' => '密码',
            'status' => '状态',
            'last_login_date' => '最后登陆时间',
            'create_user_id' => '创建人ID',
            'create_date' => '创建日期',
            'update_user_id' => '更新人ID',
            'update_date' => '更新日期',
        ];
    }
    
    public static function getUserStatusMeta(){
        return ['停用','有效'];
    }
    
    public function getStatusText(){
        return self::getUserStatusMeta()[$this->status];
    }
    
    public function getRoleList(){
        $sql="select a.id,a.name,a.description from t_role a inner join t_role_user b on a.id=b.role_id where b.user_id=:user_id";
        return Yii::$app->db->createCommand($sql,[':user_id'=>$this->id])->queryAll();
    }
    
    public function setUserRoles($roles){
        
        $sql="delete from t_role_user where user_id=:user_id";
        Yii::$app->db->createCommand($sql,[':user_id'=>$this->id])->execute();
        $rows=[];
        foreach ($roles as &$r) {
            $rows[]=[$r,$this->id];            
        }
        if(count($rows)==0){
            return;
        }
        Yii::$app->db->createCommand()->batchInsert('t_role_user', ['role_id','user_id'], $rows)->execute();
    }
    
}
