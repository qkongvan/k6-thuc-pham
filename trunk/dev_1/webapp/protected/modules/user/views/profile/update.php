<?php
$this->breadcrumbs=array(
    UserModule::t('User'),
	UserModule::t('Profile'),
);?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'updateprofile-form',
        'enableClientValidation'=>true,
    ));
    ?>

    <div class="row">
        <div class="submit">
            <?php echo CHtml::submitButton(UserModule::t('Update')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->