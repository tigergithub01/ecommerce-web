<?php

namespace app\models\product;

use Yii;

/**
 * This is the model class for table "t_product".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $type_id
 * @property string $price
 * @property string $description
 * @property integer $status
 * @property string $stock_quantity
 * @property string $safety_quantity
 * @property integer $create_user_id
 * @property string $create_date
 * @property integer $update_user_id
 * @property string $update_date
 * @property integer $can_return_flag
 * @property integer $return_days
 * @property string $return_desc
 * @property integer $regular_type_id
 * @property string $deduct_price
 * @property integer $special_deduct_flag
 * @property string $deduct_level1
 * @property string $deduct_level2
 * @property string $deduct_level3
 * @property string $deduct_level4
 */
class Product extends \yii\db\ActiveRecord
{    
    
    public $primaryPhoto;
    public $primaryPhoto_url;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'type_id', 'status', 'can_return_flag'], 'required'],
            [['type_id', 'status', 'create_user_id', 'update_user_id', 'can_return_flag', 'return_days', 'regular_type_id', 'special_deduct_flag'], 'integer'],
            [['price', 'stock_quantity', 'safety_quantity', 'deduct_price', 'deduct_level1', 'deduct_level2', 'deduct_level3', 'deduct_level4'], 'number'],
            [['description', 'return_desc'], 'string'],
            [['create_date', 'update_date'], 'safe'],
            [['code'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键编号',
            'code' => '产品唯一编码',
            'name' => '产品名称',
            'type_id' => '产品所属分类',
            'price' => '价格',
            'description' => '产品描述',
            'status' => '产品状态',
            'stock_quantity' => '库存数量',
            'safety_quantity' => '安全库存',
            'create_user_id' => '创建人',
            'create_date' => '创建日期',
            'update_user_id' => '更新日期',
            'update_date' => '更新人',
            'can_return_flag' => '是否能退货',
            'return_days' => '可退货天数',
            'return_desc' => '退货规则描述',
            'regular_type_id' => '结算规则类别',
            'deduct_price' => '产品分润单价',
            'special_deduct_flag' => '是否单独设置分润比例',
            'deduct_level1' => '一级分润比例',
            'deduct_level2' => '二级分润比例',
            'deduct_level3' => '三级分润比例',
            'deduct_level4' => '四级分润比例',
        ];
    }
    
    public function getTypeName(){
        $d= (new \yii\db\Query())
                ->select("name")
                ->from(ProductType::tableName())
                ->where(['id'=>$this->type_id])
                ->column();
        
        return empty($d)?"":implode('', $d);
    }
    
    public function getCreateUserName(){
         return $this->getUserName($this->create_user_id);
    }
    
     public function getUpdateUserName(){
        return $this->getUserName($this->update_user_id);
    }
    
    private function getUserName($user_id){
        $d= (new \yii\db\Query())
                ->select("user_name")
                ->from('t_user')
                ->where(['id'=>$user_id])
                ->column();
        
        return empty($d)?"":implode('', $d);
    }
    
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'type_id']);
    }
    
    public static function generateCode(){
        return md5(time());
    }
    
    public  static function getPhotos($product_id){
        return $query=(new \yii\db\Query())
                ->from('t_product_photo')
                ->where(['product_id'=>$product_id])
                ->all();
    }
    
    /***
     * 添加图片
     */
     public static function AddPhotos(array $photoArray,$product_id){
         
         if(empty($photoArray)){
             return;
         }
         
         $values=[];
         foreach ($photoArray as &$item) {
             $item['url']=  substr($item['url'], strlen(Yii::getAlias('@web')));
             $values[]=[$product_id,$item['url'],$item['primary_flag']];             
         }
         
        $db=\Yii::$app->db;
        $db->createCommand()->batchInsert('t_product_photo',['product_id','url','primary_flag'],$values)
                ->execute();
    }
    
    public static function deleteAllPic($product_id,$pic_id){
        
        $db=\Yii::$app->db;
        $query=(new \yii\db\Query())
                ->from('t_product_photo')
                ->where(['product_id'=>$product_id]);
        
        if($pic_id){
            $query->andWhere(['id'=>$pic_id]);
        }
        
        $pics=$query->all();
        
        foreach ($pics as $item) {
            $file=Yii::getAlias('@webroot').$item['url'];
            if(file_exists($file)){
                @unlink($file);
            }
        }
        
        $deleteCondition=['product_id'=>$product_id];
        if($pic_id){
            $deleteCondition['id']=$pic_id;
        }
        
        $db->createCommand()->delete('t_product_photo',$deleteCondition)
                ->execute();
    }
}
