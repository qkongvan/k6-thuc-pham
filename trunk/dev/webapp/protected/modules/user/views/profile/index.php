<?php
$this->breadcrumbs=array(
    UserModule::t('User'),
	UserModule::t('Profile'),
);?>

<div class="h_module_user_profile">

	<h1><?php echo UserModule::t('Profile'); ?></h1>

	<table class="dataGrid">
	    <tr>
	        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
	        <td><?php echo CHtml::encode($model->username); ?></td>
	    </tr>
	    <tr>
	        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
	        <td><?php echo CHtml::encode($model->email); ?></td>
	    </tr>
	    <tr>
	        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('createtime')); ?></th>
	        <td><?php echo date("d/m/Y H:i:s",$model->createtime); ?></td>
	    </tr>
	    <tr>
	        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit')); ?></th>
	        <td><?php echo date("d/m/Y H:i:s",$model->lastvisit); ?></td>
	    </tr>
	    <tr>
	        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
	        <td><?php echo ($model->status==User::STATUS_ACTIVE?UserModule::t('Active'):UserModule::t('No Active')) ?></td>
	    </tr>
	</table>
	
</div>