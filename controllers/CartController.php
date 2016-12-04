<?php
namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use app\models\OrderItems;
use app\models\Order;
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
                $success_text = 'Success';
                $error_text = 'Error';
    		$session =Yii::$app->session;
                $session->open();
                $this->setMeta('Cart');
                $order = new Order();
                if ($order->load(Yii::$app->request->post())) {
                    $order->qty = $session['cart.qty'];
                    $order->sum = $session['cart.sum'];
                    $transaction = Yii::$app->db->beginTransaction();           # adding transaction check
                    if ($order->save()) {
                        $this->saveOrderItems($session['cart'], $order->id);
                        Yii::$app->session->setFlash('success',  $success_text);
                        $session->remove('cart');
                        $session->remove('cart.qty');
                        $session->remove('cart.sum');
                        
                        return $this->refresh();
                        $transaction->commit();
                        return true;
                } else {
                    Yii::$app->session->setFlash('error',  $error_text);
                    $transaction->rollback();
                    return false;
                }
                }
                
    		return $this->render('view', compact('session', 'order'));
            }
            protected function saveOrderItems($items, $order_id){
                foreach($items as $id => $item) :
                    $order_items = new OrderItems();
                    $order_items->order_id = $order_id;
                    $order_items->product_id = $id;
                    $order_items->name = $item['name'];
                    $order_items->price = $item['price'];
                    $order_items->qty_item = $item['qty'];
                    if ($item['price'] !== 0) {
                       $order_items->sum_item = $item['qty'] * $item['price'];
                    } else {
                        $order_items->sum_item = 0;
                    }
                    
                    $order_items->save();

                endforeach;
            }
        
        
	}