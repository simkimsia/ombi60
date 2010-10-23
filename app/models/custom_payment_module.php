<?php
class CustomPaymentModule extends AppModel {
	var $name = 'CustomPaymentModule';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ShopsPaymentModule' => array(
			'className' => 'ShopsPaymentModule',
			'foreignKey' => 'shop_payment_module_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>