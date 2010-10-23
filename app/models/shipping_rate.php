<?php
class ShippingRate extends AppModel {
	var $name = 'ShippingRate';
	var $displayField = 'name';
	
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasOne = array(
		'PriceBasedRate' => array(
			'className' => 'PriceBasedRate',
			'foreignKey' => 'shipping_rate_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'WeightBasedRate' => array(
			'className' => 'WeightBasedRate',
			'foreignKey' => 'shipping_rate_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $belongsTo = array(
		'ShippedToCountry' => array(
			'className' => 'ShippedToCountry',
			'foreignKey' => 'shipped_to_country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	var $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Name is required.'
			),
		),
		'price' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Shipping price requires a number'
			),
			'positive' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => 'Shipping price should be at least $0.00'
			),
		),
	);
	
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id,$table,$ds);
		$this->virtualFields = array(
			'display_name'=>"CONCAT(`{$this->alias}`.`name`,' $', FORMAT(`{$this->alias}`.`price`, 2))"
		);
	}

}
?>