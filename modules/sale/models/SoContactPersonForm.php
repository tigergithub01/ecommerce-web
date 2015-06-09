<?php

namespace app\modules\sale\models;

use Yii;
use yii\base\Model;


class SoContactPersonForm extends Model
{
    
	public $name;
	public $phone_number;
	public $province_id;
	public $city_id;
	public $district_id;
	public $detail_address;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone_number', 'province_id', 'city_id', 'district_id'], 'required'],
            //[['province_id', 'city_id', 'district_id'], 'integer'],
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
            'name' => '收货人姓名',
            'phone_number' => '收货人手机号码',
            'province_id' => '收货省份',
            'city_id' => '收货城市',
            'district_id' => '所属片区',
            'detail_address' => '收货详细地址',
        ];
    }
}
