<?php

Yii::import('behaviors.nestedsetbehavior.ENestedSetBehavior');

class HNestedSetBehavior extends ENestedSetBehavior
{
	public $options = array();
	
	/**
	 * toArray - Phương thức dùng để chuyển tree sang array
	 *
	 * @author huytbt
	 * @date 2011-08-09
	 * @version 1.0
	 * 
	 * @param model $collection
	 * @param array $arrFields
	 * @param string $level_key
	 * @return array 
	 */
	public function toArray($collection, $arrFields = array(), $level_key = 'level')
	{
		// Trees mapped
		$trees = array();
		$l = 0;

		if (count($collection) > 0) {
			// Node Stack. Used to help building the hierarchy
			$stack = array();

			foreach ($collection as $node)
			{
				$item[$level_key] = $node->$level_key;
				$item['item'] = $node;
				$item['children'] = array();

				// Number of stack items
				$l = count($stack);

				// Check if we're dealing with different levels
				while ($l > 0 && $stack[$l - 1][$level_key] >= $item[$level_key])
				{
					array_pop($stack);
					$l--;
				}

				// Stack is empty (we are inspecting the root)
				if ($l == 0) {
					// Assigning the root node
					$i = count($trees);
					$trees[$i] = $item;
					$stack[] = & $trees[$i];
				} else {
					// Add node to parent
					$i = count($stack[$l - 1]['children']);
					$stack[$l - 1]['children'][$i] = $item;
					$stack[] = & $stack[$l - 1]['children'][$i];
				}
			}
		}

		return $trees;
	}
	
	function &getNode(&$stack, $parent_id) {
		$last_node = &$stack[count($stack)-1];
		if ($parent_id == $last_node[$model->alias]['id']) {
			return $last_node;
		} else {
			array_pop($stack);
			return $this->getNode($stack, $parent_id);
		}
	}
}