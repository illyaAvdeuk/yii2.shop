<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Carousel;
?>
<section id="advertisement">
    <div class="container">
        <img src="/images/shop/1.jpg" alt="advertisement" />
    </div>
</section>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php echo Carousel::widget([
    'items' => [
        // the item contains only the image
        [
            'content' => '<div class="item"><div class="col-sm-6"><img src="/images/home/girl1.jpg"/></div>',
            'caption' => '<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div></div>',
           // 'options' => [...],
        ],

        // equivalent to the above
        #['content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-02.jpg"/>'],
        // the item contains both the image and the caption
        [
            'content' => '<div class="item"><div class="col-sm-6"><img src="/images/home/girl2.jpg"/></div>',
            'caption' => '<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div></div>',
           // 'options' => [...],
        ],
       [
            'content' => '<div class="item"><div class="col-sm-6"><img src="/images/home/girl3.jpg"/></div>',
            'caption' => '<div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free Ecommerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div></div>',
           // 'options' => [...],
        ],
    ]
]); ?>
				</div>
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<ul class="catalog category-products">
							<?= \app\components\MenuWidget::widget(['tpl' =>'menu']) ?>
						</ul>
						<!--/category-productsr-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="/images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
						
					</div>
				</div>
				<?php //debug($products) ?>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"><?php echo $category->name; ?></h2>
						<?php if( !empty($products) ): ?>
						<?php $i = 0; ?>
						<?php foreach ($products as $key => $product):	?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<?= Html::img("@web/images/products/{$product['img']}", ['alt' => $this->title . ' | ' . $product['name']]); ?>
										<!-- <img src="/images/products/<?php echo $product['img']; ?>" alt="<?php echo $this->title . ' | ' . $product['name']; ?>" />-->
										<h2>$<?php echo $product['price']; ?></h2>
										<p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product['id']]); ?>"><?php echo $product['name']; ?></a></p>
										<a href="#" data-id="<?= $product['id']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>$<?php echo $product['price']; ?></h2>
										<p><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product['id']]); ?>"><?php echo $product['name']; ?></a></p>
											<a data-id="<?= $product['id']; ?>" href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
									<?php if( $product['new'] ): ?>
										<?= Html::img("@web/images/home/new.png", ['class' => "new" ]); ?>
										<?php endif; ?>
										<?php if( $product['sale'] ): ?>
										<?= Html::img("@web/images/home/sale.png", ['class' => "sale" ]); ?>
										<?php endif; ?>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
						<?php $i++; 
							if( $i % 3 == 0): ?>
								<div class="clearfix"></div>
							<?php endif; ?>
						<?php endforeach; ?>
						<?php else: ?>						
						<h2>Извините, но пока товары недоступны</h2>
						<?php endif; ?>
						<div class="clearfix"></div>
							<?php if ( !empty($products) ): ?>
							<?= LinkPager::widget([
								'pagination' => $pages,
							]); ?>
							<?php endif; ?>
						<!-- <ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
						</ul> -->
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>