<?php

class ShopController extends HController
{
	public $layout = '//layouts/main';

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionResetImage()
	{
		$uploadPath = YiiBase::getPathOfAlias('webroot') . '/files/products';
		@set_time_limit(0);
		$items = ProductItem::model()->findAll();
		foreach ($items as $item) {
			$thumbsPath = $uploadPath;
			$filename = $item->image;
			@unlink($thumbsPath . '/thumb_' . $filename);
			// thumbnails image
			Yii::import("ext.EPhpThumb.EPhpThumb");
			$thumb = new EPhpThumb();
			$thumb->init(); //this is needed
			$thumb->create($uploadPath . '/' . $filename)
				  ->adaptiveResize(Yii::app()->getModule('products')->widthThumb, Yii::app()->getModule('products')->heightThumb)
				  ->save($thumbsPath . '/thumb_' . $filename);
		}
		echo 'Done!';
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}