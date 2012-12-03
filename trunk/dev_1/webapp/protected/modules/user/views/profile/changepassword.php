<?php
$this->breadcrumbs=array(
    UserModule::t('User'),
	UserModule::t('Profile'),
);?>

<div class="h_module_user_changepassword">

<h1><?php echo UserModule::t('Change Password'); ?></h1>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'changepassword-form',
        'enableClientValidation'=>true,
    ));
    ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'oldPassword'); ?>
        <?php echo $form->passwordField($model,'oldPassword'); ?>
        <?php echo $form->error($model,'oldPassword'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
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
        <div class="submit">
            <?php echo CHtml::submitButton('Change'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

</div>