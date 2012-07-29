<div class="h_module_products_category_tree">
	<?php echo $categories; ?>
</div>
<?php if (!Yii::app()->user->isGuest && Yii::app()->user->superuser==1) : ?>
<div class="h-admin-manage">
    <a class="h-dialog-link" href="<?php echo Yii::app()->createAbsoluteUrl('/news/manage_categories/admin'); ?>"><?php echo NewsModule::t('Manage Categories'); ?></a>
</div>
<?php endif ?>