<?php
$this->breadcrumbs=array(
    UserModule::t('User'),
	UserModule::t('Forgot Password'),
);?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'forgotpassword-form',
        'enableClientValidation'=>true,
    ));
    ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username'); ?>
        <?php echo $form->error($model,'username'); ?>
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
    
    <div class="row">
        <div class="submit">
            <?php echo CHtml::submitButton(UserModule::t('Submit')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->