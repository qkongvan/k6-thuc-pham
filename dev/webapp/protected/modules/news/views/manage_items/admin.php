<div>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	    'id'=>'news-item-grid',
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
                        'url' => 'Yii::app()->createAbsoluteUrl("/news/manage_items/update",array("id"=>$data->primaryKey,"category"=>isset($_GET["category"])?$_GET["category"]:""))',
                    ),
             	)
	        ),
	    ),
	)); ?>
</div>
<script>
	var box = window.parent.getDialog();
	box.dialog("option", {
		title: "<?php echo NewsModule::t('Manage News Items') . (isset($_GET['category'])&&$_GET['category']?" (Of a Category)":" (All News)")?>",
		width: 500,
		height: 360,
		minWidth: 500,
		minHeight: 360,
		buttons: {
			"<?php echo NewsModule::t('Create New News')?>": function() { window.parent.showDialog("<?php echo $this->createAbsoluteUrl('/news/manage_items/create', array('category'=>isset($_GET['category'])?$_GET['category']:'')); ?>"); }
		}
	});
</script>