<?php

namespace app\models\basic;

use Yii;

/**
 * This is the model class for table "t_city".
 *
 * @property integer $id
 * @property string $name
 * @property integer $province_id
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'province_id'], 'required'],
            [['province_id'], 'integer'],
            [['name'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'name' => '城市名称',
            'province_id' => '关联省份编号',
        ];
    }
    
    public function getProvince(){
        return $this->hasOne(Province::className(),['id'=>'province_id']);
    }
}
