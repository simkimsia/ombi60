<?php
class ShopsPaymentModule extends AppModel {
	var $name = 'ShopsPaymentModule';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $displayField = 'display_name';

	var $actsAs = array('Linkable.Linkable');

	var $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PaymentModule' => array(
			'className' => 'PaymentModule',
			'foreignKey' => 'payment_module_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasOne = array(
		'CustomPaymentModule' => array(
			'className' => 'CustomPaymentModule',
			'foreignKey' => 'shop_payment_module_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PaypalPaymentModule' => array(
			'className' => 'PaypalPaymentModule',
			'foreignKey' => 'shop_payment_module_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	var $hasMany = array(
		
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'payment_module_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
}
?>