<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_ad_info".
 *
 * @property integer $id
 * @property string $image_url
 * @property integer $sequence_id
 * @property string $redirect_url
 */
class AdInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_ad_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_url', 'sequence_id'], 'required'],
            [['sequence_id'], 'integer'],
            [['image_url', 'redirect_url'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'image_url' => '图片地址',
            'sequence_id' => '显示顺序',
            'redirect_url' => '点击后跳转关联URL',
        ];
    }
}
