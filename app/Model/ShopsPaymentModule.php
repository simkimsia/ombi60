<?php
class ShopsPaymentModule extends AppModel {
	public $name = 'ShopsPaymentModule';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $displayField = 'display_name';

	public $actsAs = array('Linkable.Linkable');

	public $belongsTo = array(
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
	
	public $hasOne = array(
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
	
	public $hasMany = array(
		
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'shops_payment_module_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	public $validate = array(
		'payment_module_id' => array(
			'onlyOnePaypalPerShop' => array(
				'rule' => array('onlyOnePaypalPerShop'),
				'message' => 'Only 1 Paypal payment method per shop',
				'on' => 'create',
			),
			
		),
		
		
	);
	
	
	
	public function onlyOnePaypalPerShop($check) {
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