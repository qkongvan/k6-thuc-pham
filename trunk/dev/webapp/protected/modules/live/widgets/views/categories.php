<div class="h_module_products_category_tree">
	<?php echo $categories; ?>
</div>
<?php if (!Yii::app()->user->isGuest && Yii::app()->user->superuser==1) : ?>
<div class="h-admin-manage">
    <a class="h-dialog-link" href="<?php echo Yii::app()->createAbsoluteUrl('/live/manage_categories/admin'); ?>"><?php echo LiveModule::t('Manage Categories'); ?></a>
</div>
<?php endif ?>