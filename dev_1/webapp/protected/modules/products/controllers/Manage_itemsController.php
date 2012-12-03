<?php

class Manage_itemsController extends HController
{
	public $defaultAction = 'admin';
	public $layout = '//layouts/dialog';

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($category = '')
	{
		$baseScriptUrl = Yii::app()->assetManager->publish(dirname(__file__) . '/../assets');
		Yii::app()->getClientScript()->registerCssFile($baseScriptUrl . '/products.css');

		$model = new ProductItem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['ProductItem'])) {
			$model->attributes = $_POST['ProductItem'];
			if (isset($_POST['ProductItem']['categories']))
				$model->categories = implode(',', $_POST['ProductItem']['categories']);

			$fileUpload = CUploadedFile::getInstance($model, 'image');
			if (isset($fileUpload) && $model->validate()) {
				$uploadPath = YiiBase::getPathOfAlias('webroot') . '/files/products'; //Yii::app()->basePath . '/../jlwebroot/upload';

				if (!is_dir($uploadPath)) {
					@mkdir($uploadPath);
					@chmod($uploadPath, 0777);
				}

				$filename = time() . mt_rand(0, 0xfff) . '.' . $fileUpload->getExtensionName();
				$fileUpload->saveAs($uploadPath . '/' . $filename);


				/**
				 * @todo chưa có setting cho thumbnail                 
				 * */

				// thumbnails image
				$thumbsPath = $uploadPath;
				Yii::import('ext.phpthumb.EasyPhpThumb');
				$thumbs = new EasyPhpThumb();
				$thumbs->init();
				$thumbs->setThumbsDirectory($thumbsPath);
				$thumbs->load($uploadPath . '/' . $filename)->resize(120, 90)->save('thumb_' . $filename);

				$model->image = $filename;
			}

			$model->created = date('Y-m-d H:i:s', time());
			$model->modified = date('Y-m-d H:i:s', time());

			if ($model->save())
				$this->redirect(array('admin', 'category' => $category));
		} else {
			if ($model->isNewRecord && $_GET['category'])
				$model->categories = $_GET['category'];
		}

		$categories = ProductCategory::model()->roots()->findAll();

		$this->render('form', array('model' => $model, 'categories' => $categories));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$baseScriptUrl = Yii::app()->assetManager->publish(dirname(__file__) . '/../assets');
		Yii::app()->getClientScript()->registerCssFile($baseScriptUrl . '/products.css');

		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['ProductItem'])) {
			$model->attributes = $_POST['ProductItem'];
			if (isset($_POST['ProductItem']['categories']))
				$model->categories = implode(',', $_POST['ProductItem']['categories']);

			$fileUpload = CUploadedFile::getInstance($model, 'image');
			if (isset($fileUpload) && $model->validate()) {
				$uploadPath = YiiBase::getPathOfAlias('webroot') . '/files/products'; //Yii::app()->basePath . '/../jlwebroot/upload';

				if (!is_dir($uploadPath)) {
					@mkdir($uploadPath);
					@chmod($uploadPath, 0777);
				}

				// Delete old image
				if ($model->image) {
					@unlink($uploadPath . '/' . $model->image);
					@unlink($uploadPath . '/thumb_' . $model->image);
				}

				$filename = time() . mt_rand(0, 0xfff) . '.' . $fileUpload->getExtensionName();
				$fileUpload->saveAs($uploadPath . '/' . $filename);

				/**
				 * @todo chưa có setting cho thumbnail                 
				 * */

				// thumbnails image
				$thumbsPath = $uploadPath;
				Yii::import('ext.phpthumb.EasyPhpThumb');
				$thumbs = new EasyPhpThumb();
				$thumbs->init();
				$thumbs->setThumbsDirectory($thumbsPath);
				$thumbs->load($uploadPath . '/' . $filename)->resize(120, 90)->save('thumb_' . $filename);

				$model->image = $filename;
			}

			if ($model->validate() && $model->removeImage && $model->image) {
				// Delete old image
				if ($model->image) {
					@unlink($uploadPath . '/' . $model->image);
					@unlink($uploadPath . '/thumb_' . $model->image);
				}
				$model->image = '';
			}

			$model->modified = date('Y-m-d H:i:s', time());

			if ($model->save())
				$this->redirect(array('admin'));
		}

		$categories = ProductCategory::model()->roots()->findAll();

		$this->render('form', array('model' => $model, 'categories' => $categories));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$model = $this->loadModel($id);
			if ($model->image) {
				$uploadPath = YiiBase::getPathOfAlias('webroot') . '/files/products';
				@unlink($uploadPath . '/' . $model->image);
				@unlink($uploadPath . '/thumb_' . $model->image);
			}
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		} else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($category = '')
	{
		$baseScriptUrl = Yii::app()->assetManager->publish(dirname(__file__) . '/../assets');
		Yii::app()->getClientScript()->registerCssFile($baseScriptUrl . '/products.css');

		if (isset($_POST['product-item-grid_c0'])) {
			foreach ($_POST['product-item-grid_c0'] as $strNewID) {
				$model = $this->loadModel($strNewID);
				$model->delete();
			}
		}

		$model = new ProductItem('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['ProductItem']))
			$model->attributes = $_GET['ProductItem'];

		if ($category) {
			$arrCat = array($category);
			$categories = ProductCategory::model()->findByPk($category);
			if ($categories) {
				$descendants = $categories->descendants()->findAll('is_active = 1');
				foreach ($descendants as $cat)
					$arrCat[] = $cat->id;
			}
			$model->categories = $arrCat;
		}

		$this->render('admin', array('model' => $model, ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = ProductItem::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-item-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
