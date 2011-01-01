<?php
class PaypalPayersPayment extends AppModel {
	var $name = 'PaypalPayersPayment';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'PaypalPayer' => array(
			'className' => 'PaypalPayer',
			'foreignKey' => 'paypal_payer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'payment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>