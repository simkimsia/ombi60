<?php
class WeightBasedRate extends AppModel {
	var $name = 'WeightBasedRate';
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
		
		'min_weight' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Minimum weight requires a number'
			),
			'positive' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => 'Minimum weight should be at least 0.0'
			),
		),
		'max_weight' => array(
			'comparison' => array(
				'rule' => array('biggerThanMinWeight'),
				'message' => 'Max weight must be equal or greater than minium weight'
			),
			'positive' => array(
				'rule' => array('positiveOrNull'),
				'message' => 'Max weight should be a number greater than 0.00'
			),
		),
	);
	
	function biggerThanMinWeight($check) {
		if (is_null($check['max_weight']) OR empty($check['max_weight'])) {
			return true;
		}
		
		if(is_numeric($this->data[$this->alias]['min_weight']) &&
		   is_numeric($this->data[$this->alias]['max_weight']) &&
		   $this->data[$this->alias]['min_weight'] <= $this->data[$this->alias]['max_weight']) {
			return true;
		}
		return false;
	}
	
	function positiveOrNull($check) {
		if (is_null($check['max_weight']) OR empty($check['max_weight'])) {
			return true;
		}
		
		if(is_numeric($this->data[$this->alias]['max_weight']) &&
		   $this->data[$this->alias]['max_weight'] >= 0) {
			return true;
		}
		return false;
	}
}
?>