<?php
class PaymentModule extends AppModel {
	var $name = 'PaymentModule';
	var $displayField = 'name';
	
	var $hasMany = array(
		
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