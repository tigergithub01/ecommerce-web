<?php

namespace app\models\vip;

use Yii;

/**
 * This is the model class for table "t_vip_address".
 *
 * @property integer $id
 * @property integer $vip_id
 * @property string $name
 * @property string $phone_number
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $district_id
 * @property string $detail_address
 * @property integer $default_flag
 * @property integer $status
 */
class VipAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_vip_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_id', 'name', 'phone_number', 'province_id', 'city_id', 'district_id', 'default_flag','status'], 'required'],
            [['vip_id', 'province_id', 'city_id', 'district_id', 'default_flag'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['phone_number'], 'string', 'max' => 20],
            [['detail_address'], 'string', 'max' => 150],
        	[['phone_number'],'match','pattern'=>'/^1[0-9]{10}$/','message'=>'{attribute}必须为1开头的11位纯数字'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'vip_id' => '会员编号',
            'name' => '收货人姓名',
            'phone_number' => '收货人手机号码',
            'province_id' => '收货省份',
            'city_id' => '收货城市',
            'district_id' => '所属片区',
            'detail_address' => '收货详细地址',
            'default_flag' => '是否设置为默认收货地址(1：是；0：否)',
        	'status' => '收货地址状态（1：有效;0:无效)',
        ];
    }
    
    public function getAreaSort(){
        $sql="select p.name as 'provnce',c.name as 'city',d.name as 'district'
from t_vip_address a left join t_province p on a.province_id=p.id
left join t_city c on a.city_id=c.id
left join t_district d on a.district_id=d.id where a.id=:id";
        
        $conn=\Yii::$app->db;
        return $conn->createCommand($sql, [':id'=>$this->id])->queryOne();
    }
}
