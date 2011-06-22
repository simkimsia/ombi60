<?php
class Variant extends AppModel {
	var $name = 'Variant';
	var $displayField = 'title';
	
	
	var $actsAs = array('UnitSystemConvertible',
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
		
		
		return true;
	}
	
	function getTemplateVariable($variants=array(), $multiple = true) {
		
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
				$result['options'] = Set::extract('{n}.value', $variant['VariantOption']);
			} else {
				$result['options'] = array();
			}
			
			$results[] = $result;
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
}
?>