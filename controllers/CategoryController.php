<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
//use AppController;
use Yii;

class CategoryController extends AppController{

    public function actionIndex(){
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->asArray()->all();
          $this->setMeta("Yii2 Shop");
        return $this->render('index', compact('hits'));
    }
    public function actionView(){
      $id =  Yii::$app->request->get('id');
    #  $products = Product::find()->where(['category_id' => $id])->asArray()->all();

      $category = Category::findOne($id);
      if( empty($category) ) {
       throw new \yii\web\HttpException(404, 'Такой категории нет. Лучше и тебя бы не было');
      }
      $query = Product::find()->where(['category_id' => $id]);
      $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'pageSizeParam' => false, 'forcePageParam' => false]);
      $products = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
      
     # debug($_SERVER);
      $this->setMeta("Yii2 Shop" . " | " . $category->name, $category->description);
     // debug($products);
      if( empty($products) ){
        \Yii::$app->view->registerMetaTag([
        'name' => 'robots',
        'content' => 'noindex, nofollow',
    ]);
      }
      return $this->render('view', compact('products', 'pages', 'category'));
    }

        public function actionSearch(){ 
        $q = trim(Yii::$app->request->get('q')); 
        $this->setMeta("Yii2 Shop" . " | " . $q);
        if(!$q){
           return $this->render('search'); 
        }      
        $query = Product::find()->where(['like', 'name', $q]); 
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'pageSizeParam' => false, 'forcePageParam' => false]); 
        $products = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
         return $this->render('search', compact('products', 'pages', 'q')); 
    }

}
