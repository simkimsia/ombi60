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
	
	
	var $validate = array(
		'transaction_id_from_gateway' => array(
			'uniqueTransaction' => array(
				'rule' => array('uniqueTransaction'),
				'message' => 'An existing transaction id for this gateway has occurred already',
			),

		),
	
	);
	
	function uniqueTransaction($check) {
		
		$transaction_idIsOn = isset($this->data[$this->alias]['transaction_id_from_gateway']);
		if ($transaction_idIsOn) {
			$transaction_id = $this->data[$this->alias]['transaction_id_from_gateway'];
			$shopsModuleId = $this->data[$this->alias]['shops_payment_module_id'];
			if (!empty($transaction_id)) {
				$this->recursive = -1;
				$payment = $this->find('first', array('conditions'=>array('transaction_id_from_gateway'=>$transaction_id,
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
		
		$sql = 'UPDATE payments SET completed = 1

			WHERE payments.transaction_id_from_gateway = "%1$s" AND shops_payment_module_id = %2$d';
		
		App::import('Sanitize');
		$shops_payment_module_id = Sanitize::escape($shops_payment_module_id);
		$transaction_id = Sanitize::escape($transaction_id);
		$escapedSql = sprintf($sql, $transaction_id, $shops_payment_module_id);
		
		return $this->query($escapedSql);
	}
}
?>