<?php 

namespace app\components;
use yii\base\Widget;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

class HitsWidget extends Widget{

 public $hitsHtml;
	public function init(){
		parent::init();
	#	ob_start();
	}

    public function run(){

       # $hit_cache = Yii::$app->cache->get('hit_cache');
      #  if( $hit_cache ) return $hit_cache;
       

        $number_items = 6;
        $hits = Product::find()->where(['hit' => '1'])->limit($number_items)->asArray()->all();
            foreach ($hits as $key => $hit) {
              if (empty($hit['img'])) {
             $hit['img'] = 'no-image.png';
              }
            }

            //$arr = debug($hits);
            $this->hitsHtml = $this->getHitsHtml($hits);
          #  Yii::$app->cache->set('hit_cache', $this->hitsHtml, 30);

           #  $content = ob_get_clean();
        //return Html::encode($content);

        return $this->hitsHtml;
    }

     protected function getHitsHtml($hits){
        $i = 0; 
        $count = count($hits);
        $str = '<div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>                        
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">';
        foreach ($hits as $hit) {
           if ($i % 3 == 0){
                $str .= '<div class="item ';
                 if ($i == 0){   $str .= "active"; } 
                  $str .= '">';
                      }

                $str .= '<div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">';
                                               $str .=   Html::img('@web/images/home/' . $hit['img'], ['option' => 'value']);                                                     
                                                $str .=    '<h2>$' . $hit['price'] . '</h2>' .
                                                    '<p>' . $hit['name'] . '</p>' .
                                                    '<a  href="' .  Url::to( ['cart/add', 'id' => $hit['id'] ]) .'" type="button" data-id=' . $hit['id'] . ' class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                     $i++;
            if ($i % 3 == 0){
                $str .= '</div>';
                      }
        }
        $str .= '</div> <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i></a>
                              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>          
                        </div>
                    </div>';
        return $str;
    }

}   

