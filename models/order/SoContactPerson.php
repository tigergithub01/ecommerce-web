<?php

namespace app\models\order;

use Yii;

/**
 * This is the model class for table "t_so_contact_person".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $name
 * @property string $phone_number
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $district_id
 * @property string $detail_address
 */
class SoContactPersonForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_so_contact_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'name', 'phone_number', 'province_id', 'city_id', 'district_id'], 'required'],
            [['order_id', 'province_id', 'city_id', 'district_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['phone_number'], 'string', 'max' => 20],
            [['detail_address'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'order_id' => '关联订单编号',
            'name' => '收货人姓名',
            'phone_number' => '收货人手机号码',
            'province_id' => '收货省份',
            'city_id' => '收货城市',
            'district_id' => '所属片区',
            'detail_address' => '收货详细地址',
        ];
    }
}
