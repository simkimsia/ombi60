<?php
class PriceBasedRate extends AppModel {
	var $name = 'PriceBasedRate';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ShippingRate' => array(
			'className' => 'ShippingRate',
			'foreignKey' => 'shipping_rate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $validate = array(
		
		'min_price' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Minimum purchase price requires a number'
			),
			'positive' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => 'Minimum purchase price should be at least $0.00'
			),
		),
		'max_price' => array(
			'comparison' => array(
				'rule' => array('biggerThanMinPrice'),
				'message' => 'Max purchase price must be equal or greater than minium price'
			),
			'positive' => array(
				'rule' => array('positiveOrNull'),
				'message' => 'Max purchase price should be a number greater than 0.00'
			),
		),
	);
	
	
	function biggerThanMinPrice($check) {
		if (is_null($check['max_price']) OR empty($check['max_price'])) {
			return true;
		}
		
		if(is_numeric($this->data[$this->alias]['min_price']) &&
		   is_numeric($this->data[$this->alias]['max_price']) &&
		   $this->data[$this->alias]['min_price'] <= $this->data[$this->alias]['max_price']) {
			return true;
		}
		return false;
	}
	
	function positiveOrNull($check) {
		
		if (is_null($check['max_price']) OR empty($check['max_price'])) {
			return true;
		}
		
		if(is_numeric($this->data[$this->alias]['max_price']) &&
		   $this->data[$this->alias]['max_price'] >= 0) {
			return true;
		}
		return false;
	}
}
?>