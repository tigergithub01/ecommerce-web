<?php

namespace app\modules\api\service;

use Yii;
use app\models\product\Product;
use app\models\product\ProductPhoto;
use app\models\vip\Vip;
use app\models\system\Parameter;
use app\modules\sale\models\SaleConstants;
use app\models\order\ShoppingCart;

class VipCartService {
	
	/**
	 *
	 * @param unknown $vip_id        	
	 * @return unknown
	 */
	function getShoppingCartList($vip_id) {
		$dataList = ShoppingCart::find ()->where ( 'vip_id=:vip_id', [ 
				':vip_id' => $vip_id 
		] )->orderBy ( [ 
				'create_date' => SORT_ASC 
		] )->all ();
		
		if (! empty ( $dataList )) {
			foreach ( $dataList as $cart ) {
				$product = Product::findOne ( $cart->product_id );
				
				// get main photo
				$productPhoto = ProductPhoto::find ()->where ( 'product_id=:product_id', [ 
						':product_id' => $product ['id'] 
				] )->andWhere ( 'primary_flag=1' )->one ();
				$product->primaryPhoto = $productPhoto;
				
				$cart->setProduct ( $product );
			}
		}
		return $dataList;
	}
}