<?php

/**
 * ProductCartWidget - Widget dùng để render Cart
 * 
 * @author huytbt
 * @date 2011-11-08
 * @version 1.0
 */
class ProductCartWidget extends HWidget
{
	/**
     * run - Phương thức dùng để render nội dung widget
     */
    public function run()
    {
		Yii::import('application.modules.products.ProductsModule');
		
        // Đăng ký assets
        $baseScriptUrl = Yii::app()->assetManager->publish(dirname(__FILE__) . '/../assets');
        Yii::app()->getClientScript()->registerScriptFile($baseScriptUrl . '/products.js');
        Yii::app()->getClientScript()->registerCoreScript('cookie');
        
		$this->render('cart', array(
			'baseScriptUrl' => $baseScriptUrl,
		));
    }
}