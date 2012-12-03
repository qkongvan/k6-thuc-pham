<?php

Yii::import('zii.widgets.jui.CJuiInputWidget');

/**
 * HTreeDropDownList class file.
 *
 * @author huytbt
 * @date 2011-08-01
 * @version 1.0
 */
class HTreeDropDownList extends CJuiInputWidget
{
	public $listRoots = array();
	public $findByAttributes = array();
	
	/**
	 * Run this widget.
	 * This method registers necessary javascript and renders the needed HTML code.
	 */
	public function run()
	{
		list($name,$id)=$this->resolveNameID();

		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];
		else
			$this->htmlOptions['name']=$name;
		
		//$items = $this->data->roots()->findAll($this->dataCondition, $this->paramsCondition);
		$items = $this->listRoots;
		$html = '';
		$html .=  CHtml::openTag('div', array('class' => 'jlb_tree_drop_down_list'));
		$html .=  CHtml::openTag('select', $this->htmlOptions);
		if (count($items)) {
			foreach($items as $item) {
				$htmlOptions = array();
				$htmlOptions['value'] = $item->id;
				if ($this->model->parent_id == $item->id)
					$htmlOptions['selected'] = 'selected';
				$html .= CHtml::openTag('option', $htmlOptions);
				$html .= CHtml::encode($item->name);
				$html .= CHtml::closeTag('option');
				$descendants = $item->descendants()->findAllByAttributes($this->findByAttributes);
				$trees = $item->toArray($descendants);
				$html .= $this->renderDropDownList($trees);
			}
			
		} else {
			$html .= CHtml::tag('option', array('value'=>'root'), 'Root', false);
		}
		$html .= CHtml::closeTag('select');
		$html .= CHtml::closeTag('div');
		echo $html;
		//Yii::app()->clientScript->registerScript(__CLASS__.'#'.$this->htmlOptions['id'], $this->_getScript(), CClientScript::POS_READY);
	}
	
	public function renderDropDownList($items, $s = '')
	{
		$html = '';
		foreach($items as $index => $item) {
			$htmlOptions = array();
			$htmlOptions['value'] = $item['item']->id;
			if ($this->model->parent_id == $item['item']->id)
				$htmlOptions['selected'] = 'selected';
			$html .= CHtml::openTag('option', $htmlOptions);
			$spaces = $s . str_repeat('&nbsp;', 1);
			$html .= $spaces . CHtml::encode(($index==count($items)-1?'└':'├') . '─ ' . $item['item']->name);
			$html .= CHtml::closeTag('option');
			$html .= $this->renderDropDownList($item['children'], $s.str_repeat('&nbsp;', 5).($index<count($items)-1?'│':'&nbsp;&nbsp;'));
		}
		return $html;
	}
	
	private function _getScript()
    {
        $js = <<<EOD
    function splitTransformSelectTitle() {
		var st = $(".jlb_tree_drop_down_list .jqTransformSelectWrapper div span").text();
		var s = st.indexOf("─ ");
		if (s >= 0) {
			s += 2;
			st2 = st.substr(s, st.length - s);
			$(".jlb_tree_drop_down_list .jqTransformSelectWrapper div span").text(st2);
		}
	}
    $(".jlb_tree_drop_down_list .jqTransformSelectWrapper ul li a").click(splitTransformSelectTitle);
	splitTransformSelectTitle();
EOD;
		return $js;
    }
}