<?php
$this->breadcrumbs=array(
	'Shop',
);?>

<div class="body_960">
	<div class="container_16 h_module_news">

		<div class="grid_3" id="h-shop-categories">
			<h2>Categories</h2>
			<div>
			<?php $this->widget('application.modules.news.widgets.NewsCategoriesWidget'); ?>
			</div>
		</div>

		<div class="grid_16" id="h-shop-items">
			<h2>News</h2>
			<div>
			<?php $this->widget('application.modules.news.widgets.NewsItemsWidget'); ?>
			</div>
		</div>

	</div>
</div>