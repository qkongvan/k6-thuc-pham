<div>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	    'id'=>'live-item-grid',
	    'dataProvider'=>$model->search(),
	    'columns'=>array(
	    	'id',
	        'title',
	        'short_content',
	        array(
	            'class'=>'CButtonColumn',
	            'template' => '{update}{delete}',
	            'buttons' => array(
                    'update' => array(
                        'url' => 'Yii::app()->createAbsoluteUrl("/live/manage_items/update",array("id"=>$data->primaryKey,"category"=>isset($_GET["category"])?$_GET["category"]:""))',
                    ),
             	)
	        ),
	    ),
	)); ?>
</div>
<script>
	var box = window.parent.getDialog();
	box.dialog("option", {
		title: "<?php echo LiveModule::t('Manage Live Items') . (isset($_GET['category'])&&$_GET['category']?" (Of a Category)":" (All Live)")?>",
		width: 500,
		height: 360,
		minWidth: 500,
		minHeight: 360,
		buttons: {
			"<?php echo LiveModule::t('Create New Live')?>": function() { window.parent.showDialog("<?php echo $this->createAbsoluteUrl('/live/manage_items/create', array('category'=>isset($_GET['category'])?$_GET['category']:'')); ?>"); }
		}
	});
</script>