<?php

namespace app\models\basic;

use Yii;

/**
 * This is the model class for table "t_bank_info".
 *
 * @property integer $id
 * @property string $name
 */
class BankInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_bank_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '银行名称',
        ];
    }
}
