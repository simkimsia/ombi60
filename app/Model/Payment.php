<?php
class Payment extends AppModel {
	var $name = 'Payment';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'ShopsPaymentModule' => array(
			'className' => 'ShopsPaymentModule',
			'foreignKey' => 'shops_payment_module_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasOne = array(
		'PaypalPayersPayment' => array(
			'className' => 'PaypalPayersPayment',
			'foreignKey' => 'payment_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	
	var $validate = array(
		/*
		'token_from_gateway' => array(
			'uniqueToken' => array(
				'rule' => array('uniqueToken'),
				'message' => 'An existing live TOKEN for this gateway has occurred already',
			),

		),
		*/
	
	);
	
	function uniqueToken($check) {
		
		$transaction_idIsOn = isset($this->data[$this->alias]['token_from_gateway']);
		$gatewayOn = isset($this->data[$this->alias]['gateway_name']);
		if ($transaction_idIsOn && $gatewayOn) {
			$token = $this->data[$this->alias]['token_from_gateway'];
			$gateway = $this->data[$this->alias]['gateway_name'];
			$shopsModuleId = $this->data[$this->alias]['shops_payment_module_id'];
			if (!empty($transaction_id)) {
				$this->recursive = -1;
				$payment = $this->find('first', array('conditions'=>array('token_from_gateway'=>$token,
											  'gateway_name' => $gateway,
											  'status' => PAYMENT_PENDING,
											  'shops_payment_module_id'=>$shopsModuleId)));
				
				if (!$payment) {
					if (isset($this->data[$this->alias]['id'])) {
						if ($payment['Payment']['id'] != $this->data[$this->alias]['id']) {
							return false;
						}
					}
				}
			}
		}
		
		return true;
		
	}
	
	
	function completeByTransaction($shops_payment_module_id, $transaction_id) {
		
		return $this->updateAll(array('completed'=>1),
					array('transaction_id_from_gateway' => "'" . $transaction_id . "'",
					      'shops_payment_module_id' => $shops_payment_module_id));
		/**
		$sql = 'UPDATE payments SET completed = 1

			WHERE payments.transaction_id_from_gateway = "%1$s" AND shops_payment_module_id = %2$d';
		
		App::uses('Sanitize', 'Utility');
		$shops_payment_module_id = Sanitize::escape($shops_payment_module_id);
		$transaction_id = Sanitize::escape($transaction_id);
		$escapedSql = sprintf($sql, $transaction_id, $shops_payment_module_id);
		
		return $this->query($escapedSql);
		**/
	}
}
?>