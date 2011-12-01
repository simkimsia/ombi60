<?php
class PaymentModule extends AppModel {
	public $name = 'PaymentModule';
	public $displayField = 'name';
	
	public $hasMany = array(
		
		'ShopsPaymentModule' => array(
			'className' => 'ShopsPaymentModule',
			'foreignKey' => 'payment_module_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => 'true',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
}
?>