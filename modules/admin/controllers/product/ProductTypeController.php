<?php

namespace app\modules\admin\controllers\product;

use Yii;
use app\models\product\ProductType;
use yii\data\ActiveDataProvider;
use app\modules\admin\controllers\MyController;
use yii\web\NotFoundHttpException;


/**
 * ProductTypeController implements the CRUD actions for ProductType model.
 */
class ProductTypeController extends MyController
{
    /**
     * Lists all ProductType models.
     * @return mixed
     */
    public function actionIndex($parent_id=null,$name=null)
    {
        $query=ProductType::find()->joinWith('parent');
        if($parent_id!==null){
            $query->where([ProductType::tableName().'.parent_id'=>$parent_id]);
        }
        if(!empty($name)){
            $query->where(ProductType::tableName().".name like concat('%',:name,'%')",[':name'=>$name]);            
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
     * Displays a single ProductType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        return $this->render('view', [
            'model' =>$this->findModel($id)
        ]);
    }

    /**
     * Creates a new ProductType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductType();
        $parentModel=new ProductType();
        
        $parentModel->load(Yii::$app->request->post());
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {            
            return $this->redirect(['create']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'parentModel'=>$parentModel
            ]);
        }
    }

    /**
     * Updates an existing ProductType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $parentModel=new ProductType();  
        if($model->parent){
            $parentModel=ProductType::findOne($model->parent->id);
        }
        $parentModel->load(Yii::$app->request->post());
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'parentModel'=>$parentModel
            ]);
        }
    }

    /**
     * Deletes an existing ProductType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductType::findOne($id)) !== null) {            
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetJson($parent_id=null)
    {
        $conn=\Yii::$app->db;
        $sql="select id,parent_id,name,(select count(*) from `t_product_type` as c where c.parent_id=a.id) as isParent from `".ProductType::tableName().'` as a where parent_id';
        if($parent_id==null){
           $sql.=' is null';
       }else{
          $sql.=' =:parent_id';          
       }

       $rows=$conn->createCommand($sql, [':parent_id'=>$parent_id])
                ->queryAll();        
        foreach ($rows as &$value) {
            $value['isParent']=$value['isParent']>0?"true":"false";
        }
        return json_encode($rows);
    }
    
    
}
