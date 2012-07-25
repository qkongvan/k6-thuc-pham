<?php

/**
 * ProductCategoriesWidget - Widget dùng để render module Product Categories
 * 
 * @author huytbt
 * @date 2011-08-30
 * @version 1.0
 */
class ProductCategoriesWidget extends HWidget
{
	/**
	 * getData - Phương thức dùng để lấy dữ liệu
	 */
	public function getData()
	{
		$arrTrees = array();
		Yii::import('application.modules.products.models.ProductCategory');
		
		$treeRoot = ProductCategory::model()->roots()->find();
		
		if ($treeRoot) {
			$descendants = $treeRoot->descendants()->findAll('is_active = 1');
			$tree = $treeRoot->toArray($descendants);
			$arrTrees = $this->__getListChilds($tree);
		}
		
		return $arrTrees;
	}
	
    /**
     * run - Phương thức dùng để render nội dung widget
     */
    public function run()
    {
		Yii::import('application.modules.products.ProductsModule');
		
        // ??ng ký assets
        $baseScriptUrl = Yii::app()->assetManager->publish(dirname(__FILE__) . '/../assets');
        
		$categories = $this->getData();
        
        if (empty($categories))
			$this->render('categories-default');
		else
			$this->render('categories', array(
				'categories' => $categories,
			));
    }
	
	private function __getListChilds($childrens)
	{
		if (!count($childrens)) return '';
		$html = CHtml::openTag('ul', array('class'=>'collapsibleList'));
		$urlAction = HController::getCurrentUrl();
		foreach ($childrens as $index => $child) {
			$html .= CHtml::openTag('li');
			$url = Yii::app()->createAbsoluteUrl($urlAction, array('action'=>'list', 'category'=>$child['item']->id));
			$html .= CHtml::link($child['item']->name, $url);
			$childItems = $this->__getListChilds($child['children']);
			if (count($childItems)) $html .= $childItems;
			$html .= CHtml::closeTag('li');
		}
		$html .= CHtml::closeTag('ul');
		
		return $html;
	}

}