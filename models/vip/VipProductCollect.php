<?php

namespace app\models\vip;

use Yii;

/**
 * This is the model class for table "t_vip_product_collect".
 *
 * @property integer $id
 * @property integer $vip_id
 * @property integer $product_id
 * @property string $collect_date
 */
class VipProductCollect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_vip_product_collect';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_id', 'product_id', 'collect_date'], 'required'],
            [['vip_id', 'product_id'], 'integer'],
            [['collect_date'], 'safe']
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
            'product_id' => '产品编号',
            'collect_date' => '收藏时间',
        ];
    }
}
