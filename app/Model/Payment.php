<?php
class Payment extends AppModel {
	public $name = 'Payment';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
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
	
	/*
	public $hasOne = array(
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
	*/
	
	public $validate = array(
		/*
		'token_from_gateway' => array(
			'uniqueToken' => array(
				'rule' => array('uniqueToken'),
				'message' => 'An existing live TOKEN for this gateway has occurred already',
			),

		),
		*/
	
	);
	
	public function uniqueToken($check) {
		
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
	
	
	public function completeByTransaction($shops_payment_module_id, $transaction_id) {
		
		return $this->updateAll(array('completed'=>1),
					array('transaction_id_from_gateway' => "'" . $transaction_id . "'",
					      'shops_payment_module_id' => $shops_payment_module_id));
	}
	
	/**
	*
	* Get Payment Options for display in Checkout process
	*
	* @param integer $shop_id
	* @return array Returns the array of Payment Options 
	**/
	public function getOptionsForCheckout($shop_id) {
		$this->ShopsPaymentModule->recursive = -1;
		
		// retrieve all payment modes because payment mode is undecided
		$shopsPaymentModules = $this->ShopsPaymentModule->find('list', array(
			'conditions'=>array(
				'ShopsPaymentModule.shop_id'=>$shop_id, 
				'ShopsPaymentModule.active' => true
			), 
		));
		
		$options = array();
		
	    foreach ($shopsPaymentModules as $module_id => $payments) {
			$pos = strpos($payments,'Paypal');
            
            if($pos === false) {
            	$options[$module_id] = $payments;
            }
            else {
             	$options[$module_id] = "<img src='/img/paypal.jpeg' style='float:left; margin-right: 5px;' />".$payments;
            }
	    }
	
		return $options;
	}
	
	/**
	*
	* returns human readable status given the database values
	**/
	public function getStatusNameGiven($status) {
		switch($status) {
			case PAYMENT_AUTHORIZED:
				return 'Authorized';
				break;
			case PAYMENT_PENDING:
				return 'Pending';
				break;
			case PAYMENT_PAID:
				return 'Paid';
				break;
			case PAYMENT_ABANDONED:
				return 'Abandoned';
				break;
			case PAYMENT_REFUNDED:
				return 'Refunded';
				break;
			case PAYMENT_VOIDED:
				return 'Voided';
				break;
				
		}
		return '';
	}
	
}
?>