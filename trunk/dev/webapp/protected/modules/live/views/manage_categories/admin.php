<div>
    <?php
	$this->widget('CTreeView',array(
		'data'=>$arrTrees,
		'animated'=>'fast', //quick animation
		'htmlOptions'=>array(
				'class'=>'jlb_treeview treeview',//there are some classes that ready to use
		),
	));
	?>
</div>
<script>
	var box = window.parent.getDialog();
	box.dialog("option", {
		title: "<?php echo LiveModule::t('Manage Live Categories')?>",
		width: 500,
		height: 400,
		minWidth: 500,
		minHeight: 400,
		buttons: {
			"<?php echo LiveModule::t('Create New Category')?>": function() { window.parent.showDialog("<?php echo $this->createAbsoluteUrl('/live/manage_categories/create'); ?>"); }
		}
	});
</script>