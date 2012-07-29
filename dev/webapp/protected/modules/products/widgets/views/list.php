<?php if ($category) : ?>
<h3><?php echo CHtml::encode($category->name); ?></h3>
<?php endif; ?>
<div class="h-module-products-entries">
	<ul>
	<?php foreach($data as $item) : ?>
		<li>
			<?php $url = Yii::app()->createAbsoluteUrl(HController::getCurrentUrl(), array('action'=>'detail', 'product'=>$item->id)); ?>
			<a href="<?php echo $url; ?>"><img title="<?php echo CHtml::encode($item->name); ?>" rel="<?php echo $item->id.'|||'.$item->price; ?>" alt="" src="<?php if ($item->image) { echo Yii::app()->createAbsoluteUrl('/') . '/files/products/thumb_' . $item->image; } else { echo $baseScriptUrl . '/no_image.gif'; } ?>" /></a>
			<h5><?php echo CHtml::link($item->name, $url); ?></h5>
			<p><?php echo ProductsModule::t('Price'); ?>: <span><?php echo CHtml::encode($item->price) . ($item->unit ? ('/' . CHtml::encode($item->unit)) : ''); ?></span></p>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
<div class="h-module-products-paginator">
<?php $this->widget('CLinkPager', array(
	'pages' => $pages,
)); ?>
</div>
<?php if (!Yii::app()->user->isGuest && Yii::app()->user->superuser==1) : ?>
<div class="h-admin-manage">
    <a class="h-dialog-link" href="<?php echo Yii::app()->createAbsoluteUrl('/products/manage_items/admin', array('category'=>isset($_GET['category'])?$_GET['category']:'')); ?>"><?php echo ProductsModule::t('Manage Product Items')?></a>
</div>
<?php endif ?>