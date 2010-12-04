<?php
class CartItem extends AppModel {

	var $name = 'CartItem';

	var $belongsTo = array(
		'Cart' => array(
			'className' => 'Cart',
			'foreignKey' => 'cart_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function beforeSave() {
		
		// placeholder for current data
		$data = $this->data;
		
		// if existing cart item, we need to check for updated prices and move the old prices to fields
		// previous_price and previous_currency		
		if(isset($this->data['CartItem']['id'])) {
			
			// get previous prices
			$previousPrices = $this->read(array('product_price',
							    'currency',
							    'previous_price',
							    'previous_currency'),$this->data['CartItem']['id']);
			
			
			
			$currentPrice = number_format($data['CartItem']['product_price'], 4);
			$currentCurrency = $data['CartItem']['currency'];
			$previousPrice = number_format($previousPrices['CartItem']['previous_price'], 4);
			$previousCurrency = $previousPrices['CartItem']['previous_currency'];
			
			// are they different?
			if (($currentPrice != $previousPrice) OR
			    ($currentCurrency != $previousCurrency)) {
				
				// then we populate the previous_price, previous_currency fields
				$data['CartItem']['previous_price'] = $previousPrices['CartItem']['product_price'];
				$data['CartItem']['previous_currency'] = $previousPrices['CartItem']['currency'];
				
			}
			
		} else {
			// newly created item hence previous prices same as current prices
			// then we populate the previous_price, previous_currency fields
			$data['CartItem']['previous_price'] = $data['CartItem']['product_price'];
			$data['CartItem']['previous_currency'] = $data['CartItem']['currency'];
		}
		
		$this->data = $data;
		
		
		return true;
	}
	
	function afterFind($results, $primary) {
		
		foreach ($results as $key => $val) {
			if (isset($val['CartItem']['product_price'])) {
				$results[$key]['CartItem']['product_price'] = number_format($results[$key]['CartItem']['product_price'], 2);
			} else {
				foreach ($val['CartItem'] as $key1=>$val1) {
					if (isset($val1['product_price'])) {
						$results[$key]['CartItem'][$key1]['product_price'] = number_format($results[$key]['CartItem'][$key1]['product_price'], 2);
					}
				}
				
			}
			
			if (isset($val['CartItem']['previous_price'])) {
				$results[$key]['CartItem']['previous_price'] = number_format($results[$key]['CartItem']['previous_price'], 2);
			} else {
				foreach ($val['CartItem'] as $key1=>$val1) {
					if (isset($val1['previous_price'])) {
						$results[$key]['CartItem'][$key1]['previous_price'] = number_format($results[$key]['CartItem'][$key1]['previous_price'], 2);
					}
				}
				
			}
			
		}
		
		return $results;
	}
	
	

}
?>