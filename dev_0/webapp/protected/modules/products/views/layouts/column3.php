<?php $this->beginContent('//layouts/main'); ?>
<!-- content -->
<div id="content">
	<?php echo $content; ?>
</div>

<!-- extras -->
<div id="extras">
	<section class="latest-issue">
		<h2>My Cart</h2>
		<div id="h-shop-cart">
			<?php $this->widget('application.modules.products.widgets.ProductCartWidget'); ?>
		</div>
	</section>
</div>
<?php $this->endContent(); ?>