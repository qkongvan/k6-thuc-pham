<div class="h-module-live-lastest-entries">
	<ul>
	<?php foreach($data as $item) : ?>
		<li>
			<?php $url = Yii::app()->createAbsoluteUrl('/live/index/index', array('action'=>'detail', 'live'=>$item->id)); ?>
			<?php echo CHtml::link($item->title, $url); ?>
		</li>
	<?php endforeach; ?>
	</ul>
</div>