<?php

Yii::import('zii.widgets.jui.CJuiInputWidget');

/**
 * jsTree class file.
 * 
 * @author huytbt
 * @date 2011-08-30
 * @version 1.0
 */
class jsTree extends CJuiInputWidget
{
	public $arrList = array();
	private $__baseScriptUrl;
	private $__arrItemSelect;

	/**
	 * Apply chosen plugin to select boxes.
	 */
	public function run()
	{
		$this->__baseScriptUrl = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets');
		Yii::app()->getClientScript()->registerCssFile($this->__baseScriptUrl . '/jstree.css');
		Yii::app()->getClientScript()->registerScriptFile($this->__baseScriptUrl . '/jquery.jstree.js', CClientScript::POS_END);
		
		list($name,$id)=$this->resolveNameID();

		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];
		else
			$this->htmlOptions['name']=$name;
		$this->htmlOptions['name'] .= '[]';
		
		// Publish extension assets
		$html = '';
		$html .= CHtml::openTag('div', $this->htmlOptions);
		$items = $this->arrList;
		$this->__arrItemSelect = explode(',', $this->model->{$this->attribute});
		$html .= CHtml::openTag('ul');
		foreach($items as $item) {
			$htmlOptions = array();
			$htmlOptions['id'] = $item->id;
			if (in_array($htmlOptions['id'],$this->__arrItemSelect))
				$htmlOptions['class'] = 'jstree-checked';
			$htmlOptions['name'] = $this->htmlOptions['name'];
			$html .= CHtml::openTag('li', $htmlOptions);
			$html .= CHtml::link($item->name, 'javascript:void(0);');
			$descendants = $item->descendants()->findAll();
			$trees = $item->toArray($descendants);
			$html .= $this->renderList($trees);
			$html .= CHtml::closeTag('li');
		}
		$html .= CHtml::closeTag('ul');
		$html .= CHtml::closeTag('div');
		
		echo $html;
		Yii::app()->clientScript->registerScript(__CLASS__.'#'.$this->htmlOptions['id'], $this->_getScript(), CClientScript::POS_END);
	}
	
	public function renderList($items)
	{
		$html = CHtml::openTag('ul');
		foreach($items as $item) {
			$htmlOptions = array();
			$htmlOptions['id'] = $item['item']->id;
			if (in_array($htmlOptions['id'],$this->__arrItemSelect))
				$htmlOptions['class'] = 'jstree-checked';
			$htmlOptions['name'] = $this->htmlOptions['name'];
			$html .= CHtml::openTag('li', $htmlOptions);
			$html .= CHtml::link($item['item']->name, 'javascript:void(0);');
			$html .= $this->renderList($item['children']);
			$html .= CHtml::closeTag('li');
		}
		$html .= CHtml::closeTag('ul');
		return $html;
	}
	
	private function _getScript()
    {
        $js = <<<EOD
			$.jstree._themes = '{$this->__baseScriptUrl}/themes/';
			$("#{$this->htmlOptions['id']}").jstree({
				"checkbox" : {
					"real_checkboxes" : true,
					"real_checkboxes_names" : function (n) { return ["{$this->htmlOptions['name']}", n[0].id]; }
				},
				"themes" : {
					"theme" : "classic",
					"icons"  : false
				},
				"plugins" : ["themes","html_data","ui","checkbox"],
			});
EOD;
		return $js;
    }

}

?>