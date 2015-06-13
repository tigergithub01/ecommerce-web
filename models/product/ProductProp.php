<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "t_product_prop".
 *
 * @property integer $id
 * @property integer $product_type_id
 * @property string $prop_name
 * @property integer $prop_type
 */
class ProductProp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_product_prop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_type_id', 'prop_name', 'prop_type'], 'required'],
            [['product_type_id', 'prop_type'], 'integer'],
            [['prop_name'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'product_type_id' => '关联产品类别编号',
            'prop_name' => '属性名称',
            'prop_type' => '属性类型',
        ];
    }
}
