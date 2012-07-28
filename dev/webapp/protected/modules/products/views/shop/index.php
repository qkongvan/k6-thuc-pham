<?php
$this->breadcrumbs=array(
	'Shop',
);?>

<div class="body_960">
<div class="container_16 h_module_products_shop">

<div class="grid_3" id="h-shop-categories">
	<h2>Categories</h2>
	<div>
	<?php $this->widget('application.modules.products.widgets.ProductCategoriesWidget'); ?>
	</div>
</div>

<div class="grid_13" id="h-shop-items">
	<h2>Products</h2>
	<div>
	<?php $this->widget('application.modules.products.widgets.ProductItemsWidget'); ?>
	</div>
</div>

<div class="grid_3" id="h-shop-cart">
	<h2>My Cart</h2>
	<div>
	<?php $this->widget('application.modules.products.widgets.ProductCartWidget'); ?>
	</div>
</div>

</div>
</div>