<?php
class PriceBasedRate extends AppModel {
	public $name = 'PriceBasedRate';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'ShippingRate' => array(
			'className' => 'ShippingRate',
			'foreignKey' => 'shipping_rate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $validate = array(
		
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
	
	
	public function biggerThanMinPrice($check) {
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
	
	public function positiveOrNull($check) {
		
		if (is_null($check['max_price']) OR empty($check['max_price'])) {
			return true;
		}
		
		if(is_numeric($this->data[$this->alias]['max_price']) &&
		   $this->data[$this->alias]['max_price'] >= 0) {
			return true;
		}
		return false;
	}
	
	public function afterSave($created) {
		if (isset($this->data[$this->alias])) {
			$message = '';
			if (isset($this->data['PriceBasedRate']['min_price']) && !empty($this->data['PriceBasedRate']['max_price'])) {
				$message = 'From $' . $this->data['PriceBasedRate']['min_price'] . ' to $' . $this->data['PriceBasedRate']['max_price'];
			} else if (isset($this->data['PriceBasedRate']['min_price'])) {
				$message = 'From $' . $this->data['PriceBasedRate']['min_price'] . ' and above';
			}
			$this->ShippingRate->id = $this->data['PriceBasedRate']['shipping_rate_id'];
			$this->ShippingRate->saveField('description', $message);
		}
	}
}
?>