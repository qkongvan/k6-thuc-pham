<?php echo ProductsModule::t('No results found.'); ?>
<?php if (!Yii::app()->user->isGuest && Yii::app()->user->superuser==1) : ?>
<div>
    <a class="h_dialog_link" href="<?php echo Yii::app()->createAbsoluteUrl('/products/manage_items/admin', array('category'=>isset($_GET['category'])?$_GET['category']:'')); ?>"><?php echo ProductsModule::t('Manage Product Items')?></a>
</div>
<?php endif ?>