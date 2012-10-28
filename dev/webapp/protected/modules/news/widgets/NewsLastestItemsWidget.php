<?php

/**
 * NewsItemsWidget - Widget dùng để render Lastest Items News in Sidebar
 * 
 * @author huytbt
 * @date 2011-10-28
 * @version 1.0
 */
class NewsLastestItemsWidget extends HWidget
{
	/**
	 * getListItems - Phương thức dùng để lấy dữ liệu
	 */
	public function getListItems($category_id = null)
	{
		Yii::import('application.modules.news.models.NewsItem');

		$model = new NewsItem('search');
		$model->unsetAttributes();
		$criteria = new CDbCriteria;

		$criteria->order = 'created DESC';

		if ($category_id) {
			Yii::import('application.modules.news.models.NewsCategory');
			$categories = NewsCategory::model()->findByPk($category_id);
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

		$search = new CActiveDataProvider($model, array('criteria' => $criteria, 'pagination' => array('pageSize' => Yii::app()->getModule('news')->entriesLastestShow, ), ));

		$data = $search->getData();

		return $data;
	}

	/**
	 * getDetail - Phương thức dùng để lấy dữ liệu
	 */
	public function getDetail($news_id = null)
	{
		Yii::import('application.modules.news.models.NewsItem');
		$data = array();
		if ($news_id)
			$data = NewsItem::model()->findByPk($news_id);
		return $data;
	}

	/**
	 * run - Phương thức dùng để render nội dung widget
	 */
	public function run()
	{
		Yii::import('application.modules.news.NewssModule');

		// Đăng ký assets
		$baseScriptUrl = Yii::app()->assetManager->publish(dirname(__file__) . '/../assets');
		Yii::app()->getClientScript()->registerCssFile($baseScriptUrl . '/news.css');
		
		$data = $this->getListItems();

		if (empty($data)) {
			$this->render('no-result');
		} else {
			$this->render('lastest', array('data' => $data, 'baseScriptUrl' => $baseScriptUrl));
		}
	}

}
