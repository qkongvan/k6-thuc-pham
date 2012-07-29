<div class="h-module-products-detail">
	<?php $url = Yii::app()->createAbsoluteUrl(HController::getCurrentUrl(), array('action'=>'detail', 'product'=>$data->id)); ?>
	<span><a href="<?php echo $url; ?>"><img class="h-product-img" width="240" alt="" rel="<?php echo $data->id.'|||'.$data->price; ?>" title="<?php echo CHtml::encode($data->name); ?>" src="<?php if ($data->image) { echo Yii::app()->createAbsoluteUrl('/') . '/files/products/' . $data->image; } else { echo $baseScriptUrl . '/no_image.gif'; } ?>" /></a></span>
	<h4>
		<?php echo CHtml::link($data->name, $url); ?>
		<?php if (!Yii::app()->user->isGuest && Yii::app()->user->superuser==1) : ?>
			<a class="h-dialog-link" href="<?php echo Yii::app()->createAbsoluteUrl('/products/manage_items/update', array('id'=>$data->id,'category'=>'')); ?>"><img src="<?php echo $baseScriptUrl . '/update.png'; ?>"/></a>
		<?php endif; ?>
	</h4>
	<p><?php echo ProductsModule::t('Price'); ?>: <span><?php echo CHtml::encode($data->price) . ($data->unit ? ('/' . CHtml::encode($data->unit)) : ''); ?></span></p>
	<p><?php echo ProductsModule::t('Number'); ?>: <input type="text" size="15" value="1" /><input class="h-button-add_tab-cart" type="button" value="<?php echo ProductsModule::t('Add to Cart'); ?>" /></p>
	<p><?php echo CHtml::encode($data->short_description); ?></p>
</div>

<div>
	<a href="#" onclick="$('#product-description').show();$('#product-contact').hide();return false;"><?php echo ProductsModule::t('Information'); ?></a> | 
	<a href="#" onclick="$('#product-contact').show();$('#product-description').hide();return false;"><?php echo ProductsModule::t('Contact'); ?></a>
</div>

<div id="product-description">
	<?php echo CHtml::encode($data->description); ?>
</div>