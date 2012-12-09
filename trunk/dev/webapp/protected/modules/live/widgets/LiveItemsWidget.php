<?php

/**
 * LiveItemsWidget - Widget dùng để render Items Lives
 * 
 * @author huytbt
 * @date 2011-08-30
 * @version 1.0
 */
class LiveItemsWidget extends HWidget
{
	private $__pagination;
	private $__category;
	/**
	 * getListItems - Phương thức dùng để lấy dữ liệu
	 */
	public function getListItems($category_id = null, $not_id = null, $pagesize = null)
	{
		Yii::import('application.modules.live.models.LiveItem');

		$model = new LiveItem('search');
		$model->unsetAttributes();
		$criteria = new CDbCriteria;

		$criteria->order = 'created DESC';

		if ($category_id) {
			Yii::import('application.modules.live.models.LiveCategory');
			$categories = LiveCategory::model()->findByPk($category_id);
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
		if ($not_id) $criteria->compare('`t`.id', '<>'.$not_id);

		$search = new CActiveDataProvider($model, array('criteria' => $criteria, 'pagination' => array('pageSize' => $pagesize!=null ? $pagesize : Yii::app()->getModule('live')->entriesShow, ), ));

		$data = $search->getData();
		$this->__pagination = $search->pagination;

		return $data;
	}

	/**
	 * getDetail - Phương thức dùng để lấy dữ liệu
	 */
	public function getDetail($live_id = null)
	{
		Yii::import('application.modules.live.models.LiveItem');
		$data = array();
		if ($live_id)
			$data = LiveItem::model()->findByPk($live_id);
		return $data;
	}

	/**
	 * run - Phương thức dùng để render nội dung widget
	 */
	public function run()
	{
		Yii::import('application.modules.live.LivesModule');

		// Đăng ký assets
		$baseScriptUrl = Yii::app()->assetManager->publish(dirname(__file__) . '/../assets');
		Yii::app()->getClientScript()->registerCssFile($baseScriptUrl . '/live.css');

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
				$live = isset($_GET['live']) ? $_GET['live'] : '';
				$data = $this->getDetail($live);

				if (empty($data)) {
					$this->render('no-result');
				} else {
					$relationItems = array();
					$categories = $data->categoryitem;
					if (count($categories))
						$relationItems = $this->getListItems($categories[0]->category_id, $live, 5);
					else
						$relationItems = $this->getListItems(null, $live, 5);
					$this->render('detail', array('data' => $data, 'relationItems' => $relationItems, 'baseScriptUrl' => $baseScriptUrl));
				}
			} else
				$this->render('no-result');
	}

}
