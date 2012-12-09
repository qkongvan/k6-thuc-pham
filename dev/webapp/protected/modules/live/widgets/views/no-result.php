<?php echo LiveModule::t('No results found.'); ?>
<?php if (!Yii::app()->user->isGuest && Yii::app()->user->superuser==1) : ?>
<div>
    <a class="h-dialog-link" href="<?php echo Yii::app()->createAbsoluteUrl('/live/manage_items/admin', array('category'=>isset($_GET['category'])?$_GET['category']:'')); ?>"><?php echo LiveModule::t('Manage Live Items')?></a>
</div>
<?php endif ?>