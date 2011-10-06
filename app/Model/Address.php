<?php

App::uses('AppModel', 'Model');
App::uses('Model', 'Model');

class Address extends AppModel {

	public $name = 'Address';
	
	public $belongsTo = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	public $hasMany = array(
		'DeliveredOrder' => array(
			'className' => 'Order',
			'foreignKey' => 'delivery_address_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BilledOrder' => array(
			'className' => 'Order',
			'foreignKey' => 'billing_address_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
	);
	
	public function getAllByCustomer($customer_id, $type) {
		return $this->find('all', array('conditions'=>array('customer_id'=>$customer_id,
								    'type' => $type)));
	}

}
?>