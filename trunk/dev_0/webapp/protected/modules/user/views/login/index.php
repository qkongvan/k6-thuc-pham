<?php
$this->breadcrumbs=array(
	UserModule::t('User'),
	UserModule::t('Login'),
);?>

<div class="h_module_user_login">

	<h1><?php echo UserModule::t('Login'); ?></h1>
	
	<p><?php echo UserModule::t('Please fill out the following form with your login credentials:'); ?></p>
	
	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
	
		<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
		
		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>
		
		<div class="row">
			<p class="hint">
			<?php echo CHtml::link(UserModule::t("Register"), '/user/register'); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"), '/user/recovery/forgotpassword'); ?>
			</p>
		</div>
		
		<div class="row rememberMe">
			<?php echo $form->checkBox($model,'rememberMe'); ?>
			<?php echo $form->label($model,'rememberMe'); ?>
			<?php echo $form->error($model,'rememberMe'); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton(UserModule::t('Login')); ?>
		</div>
		
	<?php $this->endWidget(); ?>
	</form>
	
</div>
