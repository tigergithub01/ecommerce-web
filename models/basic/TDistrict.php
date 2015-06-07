<?php

namespace app\models\basic;

use Yii;

/**
 * This is the model class for table "t_district".
 *
 * @property integer $id
 * @property string $name
 * @property integer $city_id
 */
class TDistrict extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'city_id'], 'required'],
            [['city_id'], 'integer'],
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
            'name' => '片区名称',
            'city_id' => '关联城市编号',
        ];
    }
}
