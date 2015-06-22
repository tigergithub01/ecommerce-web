<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_app_release".
 *
 * @property integer $id
 * @property string $name
 * @property string $upgrade_desc
 * @property integer $ver_no
 * @property integer $force_upgrade
 * @property string $issue_date
 * @property integer $issue_user_id
 * @property string $app_path
 */
class AppRelease extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_app_release';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'ver_no', 'force_upgrade', 'issue_date', 'issue_user_id'], 'required'],
            [['ver_no'], 'number'],
            [['force_upgrade', 'issue_user_id'], 'integer'],
            [['issue_date'], 'safe'],
            [['name'], 'string', 'max' => 60],
            [['upgrade_desc'], 'string', 'max' => 600],
            [['app_path'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'name' => '版本名称(1.1.1，字符串型)、',
            'upgrade_desc' => '版本升级描述',
            'ver_no' => '版本编号(1.0，数字型用来与app进行版本比较)',
            'force_upgrade' => '是否必须升级(1:是；0:否）',
            'issue_date' => '发布日期',
            'issue_user_id' => '发布人',
            'app_path' => '应用下载地址',
        ];
    }
}
