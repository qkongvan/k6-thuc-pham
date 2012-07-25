<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class HController extends CController
{
	/**
	 * redirectOptions
	 */
	private $_redirectOptions = array();
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/**
	 * Phương thức setRedirectOptions($arrOptions) dùng để thiết lập các Options dùng để xuất các thông báo trong trang Redirect
	 * 
	 * @param array $arrOptions $arrOptions['timeout']: thời gian chuyển trang, $arrOptions['title']: tiêu đề, $arrOptions['message']: chuỗi thông báo
	 */
	public function setRedirectOptions($arrOptions) {
		$_default = array(
			'timeout' => 2,
			'title' => "Your title",
			'message' => "Your message"
		);

		$arrOptions = CMap::mergeArray($_default, $arrOptions);
		$this->_redirectOptions = $arrOptions;
	}
	
	/**
	 * Phương thức redirect($url, $terminate=true, $statusCode=302) dùng để redirect user đến url
	 * 
	 * @param $url string/array
	 * @param $terminate boolean
	 * @param $statusCode int 
	 */
	public function redirect($url, $terminate=true, $statusCode=302) {
		if (!empty($this->_redirectOptions)) {
			
			if(is_array($url))
			{
				$route=isset($url[0]) ? $url[0] : '';
				$url=$this->createUrl($route,array_splice($url,1));
			}
			
			$this->_redirectOptions['url'] = $url;
			
			$this->render('//common/redirect', array(
				'redirectOptions' => $this->_redirectOptions
			));
			
			Yii::app()->end();
		} else {
			parent::redirect($url, $terminate, $statusCode);
		}
	}
	
	public static function getCurrentUrl()
	{
		$urlAction = '/' . Yii::app()->controller->module->id . '/' . Yii::app()->controller->id . '/' . Yii::app()->controller->action->ID;
		return $urlAction;
	}
	
}