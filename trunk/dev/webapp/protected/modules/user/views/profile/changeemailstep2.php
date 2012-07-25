<?php
$this->breadcrumbs=array(
    UserModule::t('User'),
	UserModule::t('Profile'),
);?>

<div class="h_module_user_changeemail">

<h1><?php echo UserModule::t('Change Email - Step 2'); ?></h1>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'changeemail-form',
        'enableClientValidation'=>true,
    ));
    ?>
    
    <!--div class="row">
        <?php //echo $form->labelEx($model,'verifyPassword'); ?>
        <?php //echo $form->passwordField($model,'verifyPassword'); ?>
        <?php //echo $form->error($model,'verifyPassword'); ?>
	</div-->
    
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
    
    <div class="row">
        <div class="submit">
            <?php echo CHtml::submitButton('Change'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->