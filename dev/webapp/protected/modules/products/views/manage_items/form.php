<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-item-form',
	'enableAjaxValidation'=>false,
	//'action'=>$this->createAbsoluteUrl('/products/manage_items/' . ($model->isNewRecord ? 'create' : 'update/id/'.$_GET['id'])) . '/category/'.$_GET['category'],
	'htmlOptions' => array(
		'enctype'=>'multipart/form-data'
	)
)); ?>

	<p class="note"><?php echo ProductsModule::t('Fields with <span class="required">*</span> are required.')?></p>
	

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'image'); ?>
		<?php if ($model->image) : ?><img src="<?php echo $this->createAbsoluteUrl('/') . '/files/products/' . $model->image; ?>" width="80"/><?php endif ?>
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
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>30)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit'); ?>
		<?php echo $form->textField($model,'unit',array('size'=>30)); ?>
		<?php echo $form->error($model,'unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'short_description'); ?>
		<?php echo $form->textArea($model,'short_description',array('rows'=>3, 'cols'=>40)); ?>
		<?php echo $form->error($model,'short_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>40)); ?>
		<?php echo $form->error($model,'description'); ?>
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
		<a href="<?php //echo $this->createAbsoluteUrl('/products/manage_items/admin', array('category'=>$_GET['category'])); ?>" ><input type="button" value="<?php echo ProductsModule::t('&lt; Back'); ?>" /></a>
		<?php //echo CHtml::submitButton($model->isNewRecord ? ProductsModule::t('Create') : ProductsModule::t('Save')); ?>
	</div-->

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
	var box = window.parent.getDialog();
	box.dialog("option", {
		title: "<?php echo $model->isNewRecord ? ProductsModule::t('Create New Product') : (ProductsModule::t('Update Product').' ('.CHtml::encode($model->name).')');?>",
		width: 500,
		height: 550,
		minWidth: 500,
		minHeight: 550,
		buttons: {
			"<?php echo ProductsModule::t('Manage Product Items')?>": function() { window.parent.showDialog("<?php echo $this->createAbsoluteUrl('/products/manage_items/admin', array('category'=>isset($_GET['category'])?$_GET['category']:'')); ?>"); },
			"<?php echo $model->isNewRecord ? ProductsModule::t('Create') : ProductsModule::t('Save'); ?>": function() { $('#product-item-form').submit(); }
		}
	});
</script>