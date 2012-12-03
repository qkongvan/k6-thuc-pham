<?php
$this->breadcrumbs=array(
	UserModule::t('User'),
	UserModule::t('Register'),
);
?>

<div class="h_module_user_register">

	<h1><?php echo UserModule::t('Register'); ?></h1>
	
	<p><?php echo UserModule::t('Please fill out the following form with your register credentials:'); ?></p>

	<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'registration-form',
			'enableAjaxValidation'=>true,
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		));
		?>
		
		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'textPassword'); ?>
			<?php echo $form->passwordField($model,'textPassword'); ?>
			<?php echo $form->error($model,'textPassword'); ?>
			<p class="hint">
				<?php echo UserModule::t("Minimal password length 6 symbols."); ?>
			</p>
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'verifyPassword'); ?>
			<?php echo $form->passwordField($model,'verifyPassword'); ?>
			<?php echo $form->error($model,'verifyPassword'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email'); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'verifyEmail'); ?>
			<?php echo $form->textField($model,'verifyEmail'); ?>
			<?php echo $form->error($model,'verifyEmail'); ?>
		</div>
		
		<?php if(CCaptcha::checkRequirements()): ?>
		<div class="row">
			<?php echo $form->labelEx($model,'verifyCode'); ?>
			<div>
			<?php $this->widget('CCaptcha'); ?>
			<?php echo $form->textField($model,'verifyCode'); ?>
			</div>
			<div class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
			<br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></div>
			<?php echo $form->error($model,'verifyCode'); ?>
		</div>
		<?php endif; ?>
		
		<div class="row buttons">
			<div class="submit">
				<?php echo CHtml::submitButton(UserModule::t('Register')); ?>
			</div>
		</div>
	
		<?php $this->endWidget(); ?>
	</div><!-- form -->
	
</div>