<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "t_product_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property string $description
 */
class ParentProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_parent_product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 60],
            [['description'], 'string', 'max' => 600]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'name' => '分类名称',
            'parent_id' => '上级分类编号',
            'description' => '分类描述',
        ];
    }
    
    public function getSub()
    {
        return $this->hasMany(ProductType::className(), ['id' => 'parent_id']);
    }
    
}
