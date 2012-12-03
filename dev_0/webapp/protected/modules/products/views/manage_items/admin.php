<div>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	    'id'=>'product-item-grid',
	    'dataProvider'=>$model->search(),
	    'columns'=>array(
	    	'id',
	        'name',
	        'price',
	        array(
	            'class'=>'CButtonColumn',
	            'template' => '{update}{delete}',
	            'buttons' => array(
                    'update' => array(
                        'url' => 'Yii::app()->createAbsoluteUrl("/products/manage_items/update",array("id"=>$data->primaryKey,"category"=>isset($_GET["category"])?$_GET["category"]:""))',
                    ),
             	)
	        ),
	    ),
	)); ?>
</div>
<script>
	var box = window.parent.getDialog();
	box.dialog("option", {
		title: "<?php echo ProductsModule::t('Manage Product Items') . (isset($_GET['category'])&&$_GET['category']?" (Of a Category)":" (All Products)")?>",
		width: 500,
		height: 360,
		minWidth: 500,
		minHeight: 360,
		buttons: {
			"<?php echo ProductsModule::t('Create New Product')?>": function() { window.parent.showDialog("<?php echo $this->createAbsoluteUrl('/products/manage_items/create', array('category'=>isset($_GET['category'])?$_GET['category']:'')); ?>"); }
		}
	});
</script>