<?php

namespace app\models\system;

use Yii;
use app\models\basic\Parameter;

/**
 * This is the model class for table "t_notificatioin".
 *
 * @property integer $id
 * @property integer $scope_type
 * @property string $title
 * @property string $issue_date
 * @property string $content
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scope_type', 'title', 'issue_date'], 'required'],
            [['scope_type'], 'integer'],
            [['issue_date'], 'safe'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'scope_type' => '消息发布范围(全部、个人)',
            'title' => '消息标题',
            'issue_date' => '消息发布日期',
            'content' => '消息内容',
        ];
    }
    
    public function getScopeType(){
        return $this->hasOne(Parameter::className(), ['id'=>'scope_type']);
    }
}
