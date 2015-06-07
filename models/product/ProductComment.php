<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "t_product_comment".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $vip_id
 * @property integer $result_type_id
 * @property string $content
 * @property string $comment_date
 * @property string $ip_addr
 */
class ProductComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_product_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'comment_date', 'ip_addr'], 'required'],
            [['product_id', 'vip_id', 'result_type_id'], 'integer'],
            [['comment_date'], 'safe'],
            [['content'], 'string', 'max' => 300],
            [['ip_addr'], 'string', 'max' => 15]
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
            'vip_id' => '会员编号',
            'result_type_id' => '评价结果（好评、中评、差评）',
            'content' => '评价内容',
            'comment_date' => '评价时间',
            'ip_addr' => '评价IP地址',
        ];
    }
}
