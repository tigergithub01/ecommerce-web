<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_earn_guild".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $create_user_id
 * @property string $create_date
 * @property integer $update_user_id
 * @property string $update_date
 */
class EarnGuild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_earn_guild';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content'], 'string'],
            [['create_user_id', 'update_user_id'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['title'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'title' => '标题',
            'content' => '内容',
            'create_user_id' => '创建人',
            'create_date' => '创建日期',
            'update_user_id' => '更新日期',
            'update_date' => '更新人',
        ];
    }
    
    public function getCreaterName(){
        return Yii::$app->db->createCommand('select user_name from t_user where id=:id',[':id'=>$this->create_user_id])->queryScalar();
    }
    
    public function getUpdaterName(){
        return Yii::$app->db->createCommand('select user_name from t_user where id=:id',[':id'=>$this->update_user_id])->queryScalar();
    }
}
