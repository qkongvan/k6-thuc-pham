<div class="h-module-products-detail">
	<?php $url = Yii::app()->createAbsoluteUrl(HController::getCurrentUrl(), array('action'=>'detail', 'product'=>$data->id)); ?>
	<span><a href="<?php echo $url; ?>"><img class="h-product-img" width="240" alt="" rel="<?php echo $data->id.'|||'.$data->price; ?>" title="<?php echo CHtml::encode($data->name); ?>" src="<?php if ($data->image) { echo Yii::app()->createAbsoluteUrl('/') . '/files/products/' . $data->image; } else { echo $baseScriptUrl . '/no_image.gif'; } ?>" /></a></span>
	<h4>
		<?php echo CHtml::link($data->name, $url); ?>
		<?php if (!Yii::app()->user->isGuest && Yii::app()->user->superuser==1) : ?>
			<a class="h-dialog-link" href="<?php echo Yii::app()->createAbsoluteUrl('/products/manage_items/update', array('id'=>$data->id,'category'=>'')); ?>"><img src="<?php echo $baseScriptUrl . '/update.png'; ?>"/></a>
		<?php endif; ?>
	</h4>
	<p><?php echo ProductsModule::t('Giá'); ?>: <span><?php echo CHtml::encode($data->price) . ($data->unit ? ('/' . CHtml::encode($data->unit)) : ''); ?></span></p>
	<!--p><?php echo ProductsModule::t('Number'); ?>: <input type="text" size="15" value="1" /><input class="h-button-add_tab-cart" type="button" value="<?php echo ProductsModule::t('Add to Cart'); ?>" /></p-->
	<p><?php echo CHtml::encode($data->short_description); ?></p>
</div>

<!--div style="padding:10px 0">
	<b><a href="#" onclick="$('#product-description').show();$('#product-contact').hide();return false;"><?php echo ProductsModule::t('Thông tin'); ?></a></b> | 
	<b><a href="#" onclick="$('#product-contact').show();$('#product-description').hide();return false;"><?php echo ProductsModule::t('Lợi ích'); ?></a></b>
</div-->

<div id="product-description" class="alert alert-info" style="margin-bottom:30px;width:680px">
	<?php echo CHtml::encode($data->description); ?>
</div>

<?php if (count($relationItems)) : ?>
<h2>Sản Phẩm Liên Quan</h2>
<div class="h-module-products-entries">
	<ul>
	<?php foreach($relationItems as $item) : ?>
		<li>
			<?php $url = Yii::app()->createAbsoluteUrl(HController::getCurrentUrl(), array('action'=>'detail', 'product'=>$item->id)); ?>
			<a href="<?php echo $url; ?>"><img title="<?php echo CHtml::encode($item->name); ?>" rel="<?php echo $item->id.'|||'.$item->price; ?>" alt="" src="<?php if ($item->image) { echo Yii::app()->createAbsoluteUrl('/') . '/files/products/thumb_' . $item->image; } else { echo $baseScriptUrl . '/no_image.gif'; } ?>" /></a>
			<h5><?php echo CHtml::link($item->name, $url); ?></h5>
			<p><?php echo ProductsModule::t('Price'); ?>: <span><?php echo CHtml::encode($item->price) . ($item->unit ? ('/' . CHtml::encode($item->unit)) : ''); ?></span></p>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>