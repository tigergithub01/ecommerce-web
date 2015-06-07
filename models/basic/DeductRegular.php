<?php

namespace app\models\basic;

use Yii;

/**
 * This is the model class for table "t_deduct_regular".
 *
 * @property integer $id
 * @property string $deduct_level1
 * @property string $deduct_level2
 * @property string $deduct_level3
 * @property string $deduct_level4
 */
class DeductRegular extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_deduct_regular';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deduct_level1', 'deduct_level2', 'deduct_level3', 'deduct_level4'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'deduct_level1' => '一级分润比例',
            'deduct_level2' => '二级分润比例',
            'deduct_level3' => '三级分润比例',
            'deduct_level4' => '四级分润比例',
        ];
    }
}
