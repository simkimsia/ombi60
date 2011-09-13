<?php
class Address extends AppModel {

	var $name = 'Address';
	
	var $belongsTo = array(
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
	
	var $hasMany = array(
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
	
	function getAllByCustomer($customer_id, $type) {
		return $this->find('all', array('conditions'=>array('customer_id'=>$customer_id,
								    'type' => $type)));
	}

}
?>