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
	
	/**
	*
	* Retrieve ALL the addresses that match the customer id and type.
	* We ignore associated model data.
	*
	* @param integer $customer_id Customer Id
	* @param integer $type Address Type. Either BILLING or DELIVERY
	* @return array Array of all addresses record that match the data. Returns false if otherwise
	**/
	public function getAllByCustomer($customer_id, $type) {
		$this->recursive = -1;
		return $this->find('all', array(
			'contain' => array('Country'),
			'conditions'=>array(
				'customer_id'=>$customer_id,
				'type' => $type
			)
		));
	}
	
	/**
	*
	* Get id for given data
	*
	* @param array $data Array containing address, city, region, zip_code, country, customer_id, type, full_name, phone
	* @return integer Id of address
	**/
	public function getIdByData($data) {
		$defaults = array(
			'address' => '',
			'city'	=> '',
			'region' => '',
			'zip_code' => '',
			'country' => '0',
			'customer_id' => '0',
			'type' => '0',
			'full_name' => '',
			'phone' => ''
		);
		
		$conditions = array_merge($defaults, $data);
		
		$this->recursive = -1;
		
		return $this->field('id', $data);
		
	}
	

}
?>