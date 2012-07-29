<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
	//'action'=>$this->createAbsoluteUrl('/news/manage_categories/' . ($model->isNewRecord ? 'create' : 'update/id/'.$_GET['id'])),
	'htmlOptions' => array(
		'class' => 'jlb_form_label_80',
		'enctype'=>'multipart/form-data'
	)
)); ?>

	<p class="note"><?php echo NewsModule::t('Fields with <span class="required">*</span> are required.')?></p>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'image'); ?>
		<?php if ($model->image) : ?><img src="<?php echo $this->createAbsoluteUrl('/') . '/files/news/' . $model->image; ?>" width="120"/><?php endif ?>
		<?php echo $form->fileField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
    
    <?php if ($model->image) : ?>
    <div class="row">
        <?php echo $form->labelEx($model,'removeImage'); ?>
        <?php echo $form->checkBox($model,'removeImage'); ?>
        <?php echo $form->error($model,'removeImage'); ?>
    </div>
    <?php endif ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>4, 'cols'=>40)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->checkBox($model,'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php
			$this->widget('widgets.HTreeDropDownList',array(
				'model'=>$model,
				'attribute'=>'parent_id',
				'listRoots'=>$arrTrees,
			));
		?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

	<!--div class="row">
		<a href="<?php echo $this->createAbsoluteUrl('/news/manage_categories/admin'); ?>" ><input type="button" value="<?php echo NewsModule::t('&lt; Back'); ?>" /></a>
		<?php //echo CHtml::submitButton($model->isNewRecord ? NewsModule::t('Create') : NewsModule::t('Save')); ?>
	</div-->

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	var box = window.parent.getDialog();
	box.dialog("option", {
		title: "<?php echo $model->isNewRecord ? NewsModule::t('Create New Category') : (NewsModule::t('Update Category').' ('.CHtml::encode($model->name).')');?>",
		width: 500,
		height: 500,
		minWidth: 500,
		minHeight: 500,
		buttons: {
			"<?php echo NewsModule::t('Manage Categories'); ?>": function() { window.parent.showDialog("<?php echo $this->createAbsoluteUrl('/news/manage_categories/admin'); ?>"); },
			"<?php echo $model->isNewRecord ? NewsModule::t('Create') : NewsModule::t('Save'); ?>": function() { $('#category-form').submit(); }
		}
	});
</script>