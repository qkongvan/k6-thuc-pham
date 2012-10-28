<div class="h-module-news-lastest-entries">
	<ul>
	<?php foreach($data as $item) : ?>
		<li>
			<?php $url = Yii::app()->createAbsoluteUrl('/news/index/index', array('action'=>'detail', 'news'=>$item->id)); ?>
			<?php echo CHtml::link($item->title, $url); ?>
		</li>
	<?php endforeach; ?>
	</ul>
</div>