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
			'foreignKey' => 'shops_payment_module_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	var $validate = array(
		'payment_module_id' => array(
			'onlyOnePaypalPerShop' => array(
				'rule' => array('onlyOnePaypalPerShop'),
				'message' => 'Only 1 Paypal payment method per shop',
				'on' => 'create',
			),
			
		),
		
		
	);
	
	
	
	function onlyOnePaypalPerShop($check) {
		if (isset($this->data[$this->alias]['shop_id']) &&
		    isset($this->data[$this->alias]['payment_module_id'])) {
			
			
			if ($this->data[$this->alias]['payment_module_id'] == PAYPAL_PAYMENT_MODULE) {
				$count = $this->find('count', array('conditions'=>array('shop_id'=>$this->data[$this->alias]['shop_id'],
						 				        'payment_module_id'=>PAYPAL_PAYMENT_MODULE)));
				
				return ($count == 0);
			} else {
				return true;
			}
			
		}
		
		return false;
	}
	
}
?>