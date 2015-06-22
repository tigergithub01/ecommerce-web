<?php

namespace app\modules\admin\controllers\product;

use Yii;
use app\models\product\Product;
use app\models\product\ProductComment;
use yii\data\ActiveDataProvider;
use app\modules\admin\controllers\MyController;
use yii\web\NotFoundHttpException;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductCommentController extends MyController
{
    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex($name='')
    {
        return $this->render('commentIndex', [
            'dataProvider' =>  ProductComment::getList(),
        ]);
    }
    
    
}
