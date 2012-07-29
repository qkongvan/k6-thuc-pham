<?php echo NewsModule::t('No results found.'); ?>
<?php if (!Yii::app()->user->isGuest && Yii::app()->user->superuser==1) : ?>
<div>
    <a class="h-dialog-link" href="<?php echo Yii::app()->createAbsoluteUrl('/news/manage_items/admin', array('category'=>isset($_GET['category'])?$_GET['category']:'')); ?>"><?php echo NewsModule::t('Manage News Items')?></a>
</div>
<?php endif ?>