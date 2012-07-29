<?php if ($category) : ?>
<h3><?php echo CHtml::encode($category->name); ?></h3>
<?php endif; ?>
<div class="h-module-news-entries">
	<ul>
	<?php foreach($data as $item) : ?>
		<li>
			<?php $url = Yii::app()->createAbsoluteUrl(HController::getCurrentUrl(), array('action'=>'detail', 'news'=>$item->id)); ?>
			<div class="h-module-news-left-content">
				<a href="<?php echo $url; ?>"><img title="<?php echo CHtml::encode($item->title); ?>" alt="" src="<?php if ($item->image) { echo Yii::app()->createAbsoluteUrl('/') . '/assets/news/thumb_' . $item->image; } else { echo $baseScriptUrl . '/no_image.gif'; } ?>" /></a>
			</div>
			<div class="h-module-news-right-content">
				<h5><?php echo CHtml::link($item->title, $url); ?></h5>
				<p><?php echo CHtml::encode($item->short_content); ?></p>
			</div>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
<div class="h-module-news-paginator">
<?php $this->widget('CLinkPager', array(
	'pages' => $pages,
)); ?>
</div>
<?php if (!Yii::app()->user->isGuest && Yii::app()->user->superuser==1) : ?>
<div class="h-admin-manage">
    <a class="h-dialog-link" href="<?php echo Yii::app()->createAbsoluteUrl('/news/manage_items/admin', array('category'=>isset($_GET['category'])?$_GET['category']:'')); ?>"><?php echo NewsModule::t('Manage News Items')?></a>
</div>
<?php endif ?>