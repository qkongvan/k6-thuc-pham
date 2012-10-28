<?php
$this->breadcrumbs=array(
	'Shop',
);?>

<div class="body_960">
<div class="container_16 h_module_products_shop">

<div class="grid_3" id="h-shop-categories">
	<div class="h_sidebar_block">
		<h2>Danh Mục</h2>
		<div>
			<?php $this->widget('application.modules.products.widgets.ProductCategoriesWidget'); ?>
		</div>
	</div>
	
	<div class="h_sidebar_block">
		<h2>Tin Tức</h2>
		<div>
			<?php $this->widget('application.modules.news.widgets.NewsLastestItemsWidget'); ?>
		</div>
	</div>
</div>

<div class="grid_13" id="h-shop-items">
	<h2>Sản Phẩm</h2>
	<div>
	<?php $this->widget('application.modules.products.widgets.ProductItemsWidget'); ?>
	</div>
</div>

<div class="grid_3" id="h-shop-cart">
	<div class="h_sidebar_block">
		<h2>Cửa Hàng</h2>
		<div class="h-module-news-lastest-entries">
			<ul>
				<li>251 Nguyen Hoang</li>
			</ul>
			<?php //$this->widget('application.modules.products.widgets.ProductCartWidget'); ?>
		</div>
	</div>
	
	<div class="h_sidebar_block">
		<h2>Tuyển Dụng</h2>
		<div class="h-module-news-lastest-entries">
			<ul>
				<li><?php echo CHtml::link('Kỹ sư nông nghiệp', array('/site/recruitment', 'view'=>'tin1')); ?></li>
			</ul>
			<?php //$this->widget('application.modules.products.widgets.ProductCartWidget'); ?>
		</div>
	</div>
</div>

</div>
</div>