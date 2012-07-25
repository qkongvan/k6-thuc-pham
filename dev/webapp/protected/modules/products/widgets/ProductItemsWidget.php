<?php

/**
 * ProductItemsWidget - Widget dùng để render Items Products
 * 
 * @author huytbt
 * @date 2011-08-30
 * @version 1.0
 */
class ProductItemsWidget extends HWidget
{
	private $__pagination;
	private $__category;
	/**
	 * getListItems - Phương thức dùng để lấy dữ liệu
	 */
	public function getListItems($category_id = null)
	{
		Yii::import('application.modules.products.models.ProductItem');

		$model = new ProductItem('search');
		$model->unsetAttributes();
		$criteria = new CDbCriteria;

		$criteria->order = 'created DESC';

		if ($category_id) {
			Yii::import('application.modules.products.models.ProductCategory');
			$categories = ProductCategory::model()->findByPk($category_id);
			if (!$categories)
				return null;
			$this->__category = $categories;
			$descendants = $categories->descendants()->findAll('is_active = 1');

			$arrCat = array($category_id);
			foreach ($descendants as $cat)
				$arrCat[] = $cat->id;

			$criteria->with = array('categoryitem');
			$criteria->together = true;

			foreach ($arrCat as $cat)
				$criteria->compare('categoryitem.category_id', $cat, false, 'OR');
		}

		$criteria->compare('status', 1);

		$search = new CActiveDataProvider($model, array('criteria' => $criteria, 'pagination' => array('pageSize' => Yii::app()->getModule('products')->entriesShow, ), ));

		$data = $search->getData();
		$this->__pagination = $search->pagination;

		return $data;
	}

	/**
	 * getDetail - Phương thức dùng để lấy dữ liệu
	 */
	public function getDetail($product_id = null)
	{
		Yii::import('application.modules.products.models.ProductItem');
		$data = array();
		if ($product_id)
			$data = ProductItem::model()->findByPk($product_id);
		return $data;
	}

	/**
	 * run - Phương thức dùng để render nội dung widget
	 */
	public function run()
	{
		Yii::import('application.modules.products.ProductsModule');

		// Đăng ký assets
		$baseScriptUrl = Yii::app()->assetManager->publish(dirname(__file__) . '/../assets');
		Yii::app()->getClientScript()->registerCssFile($baseScriptUrl . '/products.css');

		$action = isset($_GET['action']) ? $_GET['action'] : 'list';

		if ($action == 'list') {
			$category = isset($_GET['category']) ? $_GET['category'] : '';

			$data = $this->getListItems($category);

			if (empty($data)) {
				$this->render('no-result');
			} else {
				$this->render('list', array('data' => $data, 'pages' => $this->__pagination, 'category' => $this->__category, 'baseScriptUrl' => $baseScriptUrl));
			}
		} else
			if ($action == 'detail') {
				$product = isset($_GET['product']) ? $_GET['product'] : '';
				$data = $this->getDetail($product);

				if (empty($data)) {
					$this->render('no-result');
				} else {
					$this->render('detail', array('data' => $data, 'baseScriptUrl' => $baseScriptUrl));
				}
			} else
				$this->render('no-result');
	}

}
