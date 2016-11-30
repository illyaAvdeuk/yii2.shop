<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;

  class ProductController extends AppController{

        public function actionView($id){
            $id =  Yii::$app->request->get('id');
            $product = Product::findOne($id);
            if( empty($product) ) {
             throw new \yii\web\HttpException(404, 'Такого товара нет. Как будто ты мог что-то найти');
            }
           
            $hits = Product::find()->where(['hit' => '1'])->limit(6)->asArray()->all();
            foreach ($hits as $key => $hit) {
              if (empty($hit['img'])) {
             $hit['img'] = 'no-image.png';
              }
            }
            

            if ( empty($product->img) ) {
              $product->img = 'no-image.png';
            }
            $this->setMeta("Yii2 Shop" . " | " . $product->category->name . " | " . $product->name, $product->description);
            return $this->render('view', compact('product', 'hits'));
        }
  }
