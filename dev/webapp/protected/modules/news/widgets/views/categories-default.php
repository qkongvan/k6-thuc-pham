<div class="wd-category-tree">
	<!--ul>
		<li>
			<a href="javascript:void(0);">Computer</a>
			<ul>
				<li>
					<a href="javascript:void(0);">Laptop</a>
					<ul>
						<li>
							<a href="javascript:void(0);">Acer</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);">Desktop</a>
				</li>
				<li>
					<a href="javascript:void(0);">Mouse</a>
				</li>
				<li>
					<a href="javascript:void(0);">Keyboard</a>
				</li>
			</ul>
		</li>
	</ul-->
</div>
<?php if (!Yii::app()->user->isGuest && Yii::app()->user->superuser==1) : ?>
<div>
    <a class="h-dialog-link" href="<?php echo Yii::app()->createAbsoluteUrl('/news/manage_categories/admin'); ?>"><?php echo NewsModule::t('Manage Categories'); ?></a>
</div>
<?php endif ?>