<?php
$this->breadcrumbs=array(
    UserModule::t('User'),
	UserModule::t('Profile'),
);?>

<div class="h_module_user_changeemail">

<h2><?php echo UserModule::t('Change Email - Step 1'); ?></h2>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'changeemail-form',
        'enableClientValidation'=>true,
    ));
    ?>
    
    <div class="row">
        <div class="submit">
            <?php echo CHtml::submitButton(UserModule::t('Click here if you want change email'), array('id'=>'changepassword','name'=>'changepassword')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

</div>