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
	
	var $validate = array(
		'shop_payment_module_id' => array(
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => '1 Payment module id for 1 Custom Payment module id',
				
			),
			
		),
		
	);
}
?>