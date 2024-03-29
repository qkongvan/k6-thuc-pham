<div class="h-module-news-detail">
	<?php $url = Yii::app()->createAbsoluteUrl(HController::getCurrentUrl(), array('action'=>'detail', 'news'=>$data->id)); ?>
	<h3>
		<?php echo CHtml::link($data->title, $url); ?>
		<?php if (!Yii::app()->user->isGuest && Yii::app()->user->superuser==1) : ?>
			<a class="h-dialog-link" href="<?php echo Yii::app()->createAbsoluteUrl('/news/manage_items/update', array('id'=>$data->id,'category'=>'')); ?>"><img src="<?php echo $baseScriptUrl . '/update.png'; ?>"/></a>
		<?php endif; ?>
	</h3>
</div>

<div id="news-description" style="margin-bottom:30px;text-align:justify">
	<?php echo $data->content; ?>
</div>

<?php if (count($relationItems)) : ?>
<h3>Tin Tức Liên Quan</h3>
<div class="h-module-products-entries">
	<ul>
	<?php foreach($relationItems as $item) : ?>
		<li>
			<?php $url = Yii::app()->createAbsoluteUrl(HController::getCurrentUrl(), array('action'=>'detail', 'news'=>$item->id)); ?>
			<?php echo CHtml::link($item->title, $url); ?>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>