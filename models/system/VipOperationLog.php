<?php

namespace app\models\system;

use Yii;

/**
 * This is the model class for table "t_vip_operation_log".
 *
 * @property integer $id
 * @property integer $vip_id
 * @property integer $module_id
 * @property string $op_date
 * @property string $op_ip_addr
 * @property string $op_browser_type
 * @property string $op_phone_model
 * @property string $op_url
 * @property string $op_desc
 * @property string $op_action
 * @property string $op_os_type
 */
class VipOperationLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_vip_operation_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /* [['vip_id', 'module_id', 'op_date'], 'required'], */
        	[['op_date'], 'required'],
            [['vip_id', 'module_id'], 'integer'],
            [['op_date'], 'safe'],
            [['op_desc'], 'string'],
            [['op_ip_addr'], 'string', 'max' => 30],
            [['op_browser_type','op_os_type'], 'string', 'max' => 100],
            [['op_phone_model','op_action'], 'string', 'max' => 60],
            [['op_url'], 'string', 'max' => 400]
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
            'module_id' => '关联移动端模块编号',
            'op_date' => '操作日期',
            'op_ip_addr' => '操作IP地址',
            'op_browser_type' => '浏览器类型',
            'op_phone_model' => '手机型号',
            'op_url' => '操作对应完整URL',
            'op_desc' => '操作描述',
        	'op_action' => '操作对应的action',
        	'op_os_type' => '操作系统',
        ];
    }
}
