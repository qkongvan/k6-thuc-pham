<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'live-item-form',
	'enableAjaxValidation'=>false,
	//'action'=>$this->createAbsoluteUrl('/live/manage_items/' . ($model->isNewRecord ? 'create' : 'update/id/'.$_GET['id'])) . '/category/'.$_GET['category'],
	'htmlOptions' => array(
		'enctype'=>'multipart/form-data'
	)
)); ?>

	<p class="note"><?php echo LiveModule::t('Fields with <span class="required">*</span> are required.')?></p>
	

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'image'); ?>
		<?php if ($model->image) : ?><img src="<?php echo $this->createAbsoluteUrl('/') . '/files/live/' . $model->image; ?>" width="80"/><?php endif ?>
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
		<?php echo $form->labelEx($model,'short_content'); ?>
		<?php echo $form->textArea($model,'short_content',array('rows'=>6, 'cols'=>80)); ?>
		<?php echo $form->error($model,'short_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php //echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>40)); ?>
		<?php $this->widget('ext.ckeditor.CKEditor', array(
			'model'=>$model,
			'attribute'=>'content',
			'language'=>'vi',
			'editorTemplate'=>'full',
		)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	
	<div class="jlb_row">
		<?php echo $form->labelEx($model,'categories'); ?>
		<?php $this->widget('widgets.jsTree.jsTree', array(
			'model'=>$model,
			'attribute'=>'categories',
			'arrList'=>$categories,
			'htmlOptions'=>array(
				'style'=>'max-height:150px;overflow: auto;'
			),
		)); ?>
		<?php echo $form->error($model,'categories'); ?>
	</div>	
	
	<!--div class="row">
		<a href="<?php //echo $this->createAbsoluteUrl('/live/manage_items/admin', array('category'=>$_GET['category'])); ?>" ><input type="button" value="<?php echo LiveModule::t('&lt; Back'); ?>" /></a>
		<?php //echo CHtml::submitButton($model->isNewRecord ? LiveModule::t('Create') : LiveModule::t('Save')); ?>
	</div-->

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
	var box = window.parent.getDialog();
	box.dialog("option", {
		title: "<?php echo $model->isNewRecord ? LiveModule::t('Create New Live') : (LiveModule::t('Update Live').' ('.CHtml::encode($model->title).')');?>",
		width: 1000,
		height: 650,
		minWidth: 1000,
		minHeight: 650,
		buttons: {
			"<?php echo LiveModule::t('Manage Live Items')?>": function() { window.parent.showDialog("<?php echo $this->createAbsoluteUrl('/live/manage_items/admin', array('category'=>isset($_GET['category'])?$_GET['category']:'')); ?>"); },
			"<?php echo $model->isNewRecord ? LiveModule::t('Create') : LiveModule::t('Save'); ?>": function() { $('#live-item-form').submit(); }
		}
	});
</script>