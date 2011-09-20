<?php
class VariantModel extends AppModel {
	public $name = 'Variant';
	
	public $alias = 'Variant';
	public $useTable = 'variants';
	
	public $displayField = 'title';
	
	
	public $actsAs = array('UnitSystemConvertible'=>array(''),
			    'Copyable.Copyable' => array(
					'recursive' => true));
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed



	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
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
	public function beforeSave() {
		
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
		$productAbsent = empty($this->data['Product']);
		
		// even if we do not have options, we will NEVER return false
		// this is due to the saveAll at the Product level
		
		if ($optionsPresent) {
			$variantTitle = '';
			foreach($this->data['VariantOption'] as $key => $option) {
				$variantTitle = $variantTitle . $option['value'] . ' / ';
			}
			$variantTitle = rtrim($variantTitle, " / ");
			$this->data['Variant']['title'] = $variantTitle;
		} 
		
		return true;
	}
	
	public function getTemplateVariable($variants=array(), $multiple = true) {
		App::uses('ArrayToIterator', 'Lib');
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
					// hardcode available for testing checkout process
					'available'				=> 1,
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
	
	public function afterSave($created) {
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
	public function afterFind($results, $primary) {
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