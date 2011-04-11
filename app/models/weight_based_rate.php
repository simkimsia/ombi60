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
	
	
	var $actsAs    = array(
			       'UnitSystemConvertible' => array(
					'weight_fields' =>array(
						'min_weight',
						'max_weight',
							)
								),
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
	
	function afterSave($created) {
		if (isset($this->data[$this->alias])) {
			$unit = $this->data['WeightBasedRate']['unit'];
			$message = '';
			if (isset($this->data['WeightBasedRate']['displayed_min_weight']) && !empty($this->data['WeightBasedRate']['displayed_max_weight'])) {
				$message = 'From ' . $this->data['WeightBasedRate']['displayed_min_weight'] . $unit . ' to ' . $this->data['WeightBasedRate']['displayed_max_weight'] . $unit;
			} else if (isset($this->data['WeightBasedRate']['displayed_min_weight'])) {
				$message = 'From ' . $this->data['WeightBasedRate']['displayed_min_weight'] . $unit . ' and above';
			}
			$this->ShippingRate->id = $this->data['WeightBasedRate']['shipping_rate_id'];
			$this->ShippingRate->saveField('description', $message);
		}
	}
	
	/**
	 * For unit conversion
	 * */
	function afterFind($results, $primary) {
		
                $unit = Shop::get('ShopSetting.unit_system');
		
		foreach ($results as $key => $val) {
			if (isset($val[$this->alias])) {
				$results[$key] = $this->convertForDisplay($val, $unit);
			}
		}
		
		
		return $results;
	}
	
	/**
	 * For unit conversion
	 * */
	function beforeSave() {
		
                $unit = Shop::get('ShopSetting.unit_system');
		
		foreach ($this->data as $key => $val) {
			if (isset($val[$this->alias])) {
				$this->data[$key] = $this->convertForSave($val, $unit);
			}
			if ($key == $this->alias) {
				$resultingProductArray = $this->convertForSave(array($key => $this->data[$key]), $unit);
				$this->data[$key] = $resultingProductArray[$key];
			}
		}
		
		
		return true;
	}
}
?>