<?php

namespace app\modules\admin\controllers\product;

use Yii;
use app\models\product\Product;
use yii\data\ActiveDataProvider;
use app\modules\admin\controllers\MyController;
use yii\web\NotFoundHttpException;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends MyController
{
    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex($name='',$type_id=null)
    {
        $query=Product::find()->joinWith('productType');
        
        if(!empty($name)){
            $query->where(Product::tableName().".name like concat('%',:name,'%')",[':name'=>$name]);
        }
        if(!empty($type_id)){
            $query->andWhere(['type_id'=>$type_id]);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' =>$query ,
            'sort'=>[
                'defaultOrder'=>['id'=>SORT_DESC]
            ],
            'pagination'=>[
                'pagesize'=>10,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    { 
        $picModel=Product::getPhotos($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'picModel'=>$picModel
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $model['create_date']= date('Y-m-d H:i:s',time());
        $model['create_user_id']=Yii::$app->user->identity->id;
        $model['update_date']= date('Y-m-d H:i:s',time());
        $model['update_user_id']=Yii::$app->user->identity->id;        
        $model['code']=  substr(md5(time()),0,30);
        $post = Yii::$app->request->post();
        $c=$model->load($post);
        
        $productPicNewModel=$this->getProductPic(0);        
        $typeName=Yii::$app->request->post('TypeName','');
        
        if ($c && $model->save()) {
            Product::AddPhotos($productPicNewModel,$model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,               
                'productPicModel'=>[],
                'productPicNewModel'=>$productPicNewModel,
                'typeName'=>$typeName
            ]);
        }
    }    

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $productPicNewModel=$this->getProductPic($model->id);
        $model['update_date']= date('Y-m-d H:i:s',time());
        $model['update_user_id']=Yii::$app->user->identity->id;
        
        $typeName=Yii::$app->request->post('TypeName',$model->getTypeName());
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Product::AddPhotos($productPicNewModel,$model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'productPicNewModel'=>$productPicNewModel,
                'productPicModel'=>Product::getPhotos($model->id),
                'typeName'=>$typeName
            ]);
        }
    }
    
    private function getProductPic($productID){
        $productPicNewModel=[];
        
        if(Yii::$app->request->isPost){            
            $pics=Yii::$app->request->post("productPicNew",[]);
            foreach ($pics as &$row){
                $row['product_id']=$productID;
                $row['primary_flag']=0;
                $productPicNewModel[]=$row;
            }                    
        }
        
        //设置默认封面
        if(count($productPicNewModel)>0 && $productID>0){
            $productPicNewModel[0]['primary_flag']=1;
        }
        
        return $productPicNewModel;
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        
        Product::deleteAllPic($model->id,0);
        $model->delete();

        return $this->redirect(['index']);
    }
    
    public function actionRemovePic($productID,$picID){
        
        if($picID>0){
            Product::deleteAllPic($productID,$picID);
        }
        return json_encode(['error'=>0,'message'=>'图片已经被删除']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
}
