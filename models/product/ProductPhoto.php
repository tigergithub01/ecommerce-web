<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "t_product_photo".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $url
 * @property integer $primary_flag
 */
class ProductPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_product_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'url', 'primary_flag'], 'required'],
            [['id', 'product_id', 'primary_flag'], 'integer'],
            [['url'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'product_id' => '关联产品编号',
            'url' => '图片地址',
            'primary_flag' => '是否设置为主图(1：是；0：否)',
        ];
    }
}
