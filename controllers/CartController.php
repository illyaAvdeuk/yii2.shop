<?php

namespace app\controllers;

use app\models\Product;
use app\models\Cart;
use Yii;

	class CartController extends AppController{

		public function actionAdd(){
	        $id = Yii::$app->request->get('id');
	        $qty = (int)Yii::$app->request->get('qty');
	        $qty = !$qty ? 1 : $qty;
	        $product = Product::findOne($id);
	        if(empty($product)) return false;
	        $session = Yii::$app->session;
	        $session->open();
	        $cart = new Cart();
	        $cart->addToCart($product, $qty);
	        if (!Yii::$app->request->isAjax) {
	        	return $this->redirect(Yii::$app->request->referrer);
	        }
	        $this->layout = false;
	        return $this->render('cart-modal', compact('session'));
    	}

		public function actionClear(){
		    $session =Yii::$app->session;
		    $session->open();
		    $session->remove('cart');
		    $session->remove('cart.qty');
		    $session->remove('cart.sum');
		    $this->layout = false;
		    return $this->render('cart-modal', compact('session'));
		}

    	public function actionDelItem(){
    		$id = Yii::$app->request->get('id');
    		$session =Yii::$app->session;
		    $session->open();
		    $cart = new Cart();
		    $cart->recalc($id);
		    $this->layout = false;
		    return $this->render('cart-modal', compact('session'));
    	}

    	public function actionRecount(){
    		$id = Yii::$app->request->get('id');
    		$new_quantity = Yii::$app->request->get('quantity');
    		$session =Yii::$app->session;
		    $session->open();
		    $cart = new Cart();
		    $cart->recount($id, $new_quantity);
		    $this->layout = false;
		    return $this->render('cart-modal', compact('session'));
    	}
    	public function actionView(){
    		$session =Yii::$app->session;
    		return $this->render('view', compact('session'));
    	}
	}