<?php
$this->breadcrumbs=array(
	'Shop',
);?>

<div class="body_960">
	<div class="container_16 h_module_news">

		<div class="grid_3" id="h-shop-categories">
			<div class="h_sidebar_block">
				<h2>Danh Mục</h2>
				<div>
				<?php $this->widget('application.modules.news.widgets.NewsCategoriesWidget'); ?>
				</div>
			</div>
		</div>

		<div class="grid_14" id="h-shop-items">
			<h2>Tin Tức</h2>
			<div>
			<?php $this->widget('application.modules.news.widgets.NewsItemsWidget'); ?>
			</div>
		</div>

	</div>
</div>