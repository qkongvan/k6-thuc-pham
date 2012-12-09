<?php

class LiveModule extends HWebModule
{
	/**
	 * @var int entries new show in page
	 */
	public $entriesShow = 20;
	public $entriesManageShow = 5;
	public $entriesLastestShow = 5;
	public $widthThumb = 198;
	public $heightThumb = 132;

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array('live.models.*', 'live.components.*', ));
	}

	public function beforeControllerAction($controller, $action)
	{
		if (parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		} else
			return false;
	}
}
