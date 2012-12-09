<?php

class Manage_categoriesController extends HController
{
	public $defaultAction = 'admin';
	public $layout = '//layouts/dialog';

	private $__baseScriptUrl;

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->__baseScriptUrl = Yii::app()->assetManager->publish(dirname(__file__) . '/../assets');
		Yii::app()->getClientScript()->registerCssFile($this->__baseScriptUrl . '/live.css');

		$model = new LiveCategory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$treeRoots = LiveCategory::model()->roots()->findAll();
		if (empty($treeRoots)) {
			$root = new LiveCategory;
			$root->name = 'Root';
			$root->saveNode();
		}

		if (isset($_POST['LiveCategory'])) {
			$model->attributes = $_POST['LiveCategory'];

			if ($model->parent_id == 'root') {
				$model->parent_id = null;
			} else {
				$model->parent_id = $_POST['LiveCategory']['parent_id'];
			}

			$fileUpload = CUploadedFile::getInstance($model, 'image');
			if (isset($fileUpload) && $model->validate()) {
				$uploadPath = YiiBase::getPathOfAlias('webroot') . '/files/live/'; //Yii::app()->basePath . '/../jlwebroot/upload';

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
				$thumbs->load($uploadPath . '/' . $filename)->resize(80, 60)->save('thumb_' . $filename);

				$model->image = $filename;
			}

			$model->created = date('Y-m-d H:i:s', time());
			$model->modified = date('Y-m-d H:i:s', time());

			if ($model->parent_id == 'root') {
				if ($model->validate()) {
					$model->saveNode();
					$this->redirect(array('admin'));
				}
			} else {
				if ($model->validate()) {
					$root = LiveCategory::model()->findByAttributes(array('id' => $model->parent_id));
					$model->appendTo($root);
					$this->redirect(array('admin'));
				}
			}
		}

		$arrTrees = LiveCategory::model()->roots()->findAll();

		$this->render('form', array('model' => $model, 'arrTrees' => $arrTrees, ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->__baseScriptUrl = Yii::app()->assetManager->publish(dirname(__file__) . '/../assets');
		Yii::app()->getClientScript()->registerCssFile($this->__baseScriptUrl . '/live.css');

		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['LiveCategory'])) {
			$model->current_parent = $model->parent_id;
			$model->attributes = $_POST['LiveCategory'];
			$model->parent_id = $_POST['LiveCategory']['parent_id'];

			$fileUpload = CUploadedFile::getInstance($model, 'image');
			if (isset($fileUpload) && $model->validate()) {
				$uploadPath = YiiBase::getPathOfAlias('webroot') . '/files/live'; //Yii::app()->basePath . '/../jlwebroot/upload';

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
				$thumbs->load($uploadPath . '/' . $filename)->resize(80, 60)->save('thumb_' . $filename);

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

			if ($model->saveNode())
				$this->redirect(array('admin'));

		}

		$arrTrees = LiveCategory::model()->roots()->findAll();

		$this->render('form', array('model' => $model, 'arrTrees' => $arrTrees, ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		// we only allow deletion via POST request
		$model = $this->loadModel($id);
		if ($model->image) {
			$uploadPath = YiiBase::getPathOfAlias('webroot') . '/files/live';
			@unlink($uploadPath . '/' . $model->image);
			@unlink($uploadPath . '/thumb_' . $model->image);
		}
		$model->deleteNode();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($moving = null)
	{
		$this->__baseScriptUrl = Yii::app()->assetManager->publish(dirname(__file__) . '/../assets');
		Yii::app()->getClientScript()->registerCssFile($this->__baseScriptUrl . '/live.css');

		$arrTrees = array();
		Yii::import('application.modules.live.models.LiveCategory');

		$treeRoots = LiveCategory::model()->roots()->findAll();
		foreach ($treeRoots as $root) {
			$row['text'] = $root->name; // . ' <img src="'.$this->__baseScriptUrl.'/update.png" /><img src="'.$this->__baseScriptUrl.'/delete.png" />';
			$descendants = $root->descendants()->findAll();
			$trees = $root->toArray($descendants, array('id', 'name'));
			$row['children'] = $this->__getDataTreeChilds($trees, $moving);
			$arrTrees[] = $row;
		}

		$this->render('admin', array('arrTrees' => $arrTrees, ));
	}

	/**
	 * actionMoveUp - Action dùng để move up
	 */
	public function actionMoveUp($id)
	{
		$node = $this->loadModel($id);
		$nodeUp = $node->getPrevSibling();
		$node->moveBefore($nodeUp);
		$this->redirect($this->createAbsoluteUrl('/live/manage_categories/admin', array('moving' => $id)));
	}

	/**
	 * actionMoveUp - Action dùng để move up
	 */
	public function actionMoveDown($id)
	{
		$node = $this->loadModel($id);
		$nodeDown = $node->getNextSibling();
		$node->moveAfter($nodeDown);
		$this->redirect($this->createAbsoluteUrl('/live/manage_categories/admin', array('moving' => $id)));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = LiveCategory::model()->findByPk($id);
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'LiveCategory-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	private function __getDataTreeChilds($childrens, $moving = null)
	{
		$arrTrees = array();

		$length = count($childrens);
		foreach ($childrens as $index => $child) {
			$strChildId = $child['item']->id;
			$linkUp = $index == 0 ? '' : '<a title="' . LiveModule::t('Move Up') . '" href="' . $this->createAbsoluteUrl('/live/manage_categories/moveup', array('id' => $strChildId)) . '"><img src="' . $this->__baseScriptUrl . '/uparrow.png" /></a>';
			$linkDown = $index == $length - 1 ? '<span style="display:inline-block;width:16px"></span>' : '<a title="' . LiveModule::t('Move Down') . '" href="' . $this->createAbsoluteUrl('/live/manage_categories/movedown', array('id' => $strChildId)) .
				'"><img src="' . $this->__baseScriptUrl . '/downarrow.png" /></a>';
			$linkUpdate = '<a title="' . LiveModule::t('Update') . '" href="' . $this->createAbsoluteUrl('/live/manage_categories/update', array('id' => $strChildId)) . '"><img src="' . $this->__baseScriptUrl . '/update.png" /></a>';
			$linkDelete = '<a title="' . LiveModule::t('Delete') . '" onClick="if (!confirm(\'' . LiveModule::t('Are you sure you want to delete?') . '\')) return false;" href="' . $this->createAbsoluteUrl('/live/manage_categories/delete', array('id' => $strChildId)) .
				'"><img src="' . $this->__baseScriptUrl . '/delete.png" /></a>';
			$title = $moving == $strChildId ? '<span style="color:#ff0000;">' . $child['item']->name . '</span>' : $child['item']->name;
			$row['text'] = $title . '<span style="float:right;">' . $linkUp . $linkDown . $linkUpdate . $linkDelete . '</span>';
			$row['children'] = $this->__getDataTreeChilds($child['children'], $moving);
			$arrTrees[] = $row;
		}

		return $arrTrees;
	}
}
