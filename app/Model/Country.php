<?php
class Country extends AppModel {
	var $name = 'Country';
	var $displayField = 'printable_name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		
		'ShippedToCountry' => array(
			'className' => 'ShippedToCountry',
			'foreignKey' => 'country_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Address' => array(
			'className' => 'Address',
			'foreignKey' => 'country',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	

}
?>