<?php
class Variant extends AppModel {
	var $name = 'Variant';
	var $displayField = 'title';
	
	
	var $actsAs = array('UnitSystemConvertible'=>array(''),
			    'Copyable.Copyable' => array(
					'recursive' => true));
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed



	var $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'CartItem' => array(
			'className' => 'CartItem',
			'foreignKey' => 'variant_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => false,
			'finderQuery' => '',
			'counterQuery' => ''
		),
		
		'OrderLineItem' => array(
			'className' => 'OrderLineItem',
			'foreignKey' => 'variant_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => false,
			'finderQuery' => '',
			'counterQuery' => ''
		),
		
		'VariantOption' => array(
			'className' => 'VariantOption',
			'foreignKey' => 'variant_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => true,
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	
	
	/**
	 * For unit conversion
	 * */
	function beforeSave() {
		
                $unit = Shop::get('ShopSetting.unit_system');
		
		foreach ($this->data as $key => $val) {
			if (isset($val['Variant'])) {
				$this->data[$key] = $this->convertForSave($val, $unit);
			}
			if ($key == 'Variant') {
				$resultingProductArray = $this->convertForSave(array($key => $this->data[$key]), $unit);
				$this->data[$key] = $resultingProductArray[$key];
			}
		}
		
		$optionsPresent = !empty($this->data['VariantOption']);
		if ($optionsPresent) {
			$variantTitle = '';
			foreach($this->data['VariantOption'] as $key => $option) {
				$variantTitle = $variantTitle . $option['value'] . ' / ';
			}
			$variantTitle = rtrim($variantTitle, " / ");
			$this->data['Variant']['title'] = $variantTitle;
		} else {
			return false;
		}
		
		return true;
	}
	
	function getTemplateVariable($variants=array(), $multiple = true) {
		App::import('Lib', 'ArrayToIterator');
		$results = array();
		
		if (!$multiple) $variants = array($variants);
		
		foreach($variants as $key=>$variant) {
			
			$variant = isset($variant['Variant']) ? $variant['Variant'] : $variant;
			$result = array('id' 			=> $variant['id'],
					'title' 		=> $variant['title'],
					'sku' 			=> $variant['sku_code'],
					'price'			=> $variant['price'],
					'weight'		=> $variant['weight'],
					'requires_shipping' 	=> $variant['shipping_required'],
					'compare_with_price' 	=> $variant['compare_with_price'],
					);
			
			if (!empty($variant['VariantOption'])) {
				$options = Set::extract('{n}.value', $variant['VariantOption']);
			} else {
				$options = array();
			}
			
			$result['options'] = (TWIG_ITERATOR) ? ArrayToIterator::array2Iterator($options) : $options;
			
			
			$results[] = $result;
		}
		
		if ($multiple && TWIG_ITERATOR) {
			$results = ArrayToIterator::array2Iterator($results);
		}
		
		if (!$multiple && !empty($results)) {
			return current($results);
		} else if (!$multiple && empty($results)) {
			return array();
		}
		
		return $results;
	}
	
	function afterSave($created) {
		if (!$created) {
			if (isset($this->data['Variant']['price']) &&
			    isset($this->data['Variant']['weight'])) {
				$this->CartItem->updatePricesAndWeights($this->id, $this->data['Variant']['price'],
								'SGD',
								$this->data['Variant']['weight'],
								'kg');
			}
			
			if(isset($this->data['Variant']['shipping_required']) &&
			   isset($this->data['Variant']['original_shipping_required'])) {
				
				if ($this->data['Variant']['shipping_required'] != $this->data['Variant']['original_shipping_required']) {
					
					$this->CartItem->toggleByConditions(array('CartItem.product_id'=>$this->data['Variant']['variant_id']), 'shipping_required');
						
				}
				
			}
		}
	}
	
	/**
	 * for unit conversion
	 **/
	function afterFind($results, $primary) {
		$unit = Shop::get('ShopSetting.unit_system');
		if ($primary) {
			
			foreach ($results as $key => $val) {
				
				if (isset($val['Variant'])) {
					$results[$key] = $this->convertForDisplay($val, $unit, $primary);
				}
			}
		} else {
			
			// in this case, we do not get back a {n}.{ModelName}.{field} format for results
			// we got back an array of {field} directly
			
			
			// but sometimes we get back a {n}.{ModelName}.{field}
			// if Containable is used by the Primary model, so
			// we need to check for {n}.{ModelName} first
			$extracted = Set::extract('{n}.Variant', $results);
			// means it is just a normal array of {field}
			if (empty($extracted)) {
				$results = $this->convertForDisplay($results, $unit, $primary);	
			} else {
				// means it is {n}.ModelName.field
				foreach ($results as $key => $val) {
				
					if (isset($val['Variant'])) {
						$results[$key] = $this->convertForDisplay($val, $unit, !$primary);
					}
				}
			}
			
		}
		
		return $results;
	}
}
?>