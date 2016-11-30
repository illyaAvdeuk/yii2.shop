<?php

namespace app\controllers;
use yii\web\Controller;

class AppController extends Controller
{
    protected function setMeta($title = null, $description = null){
    	$this->view->title = $title;
     
     if($description){
    	\Yii::$app->view->registerMetaTag([
        'name' => 'keywords',
        'content' => "$description",
   		 ]);
      }

    }
    
}
