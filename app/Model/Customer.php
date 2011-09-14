<?php
class Customer extends AppModel {

	public $name = 'Customer';
	
	public $actsAs = array('Filter.Filter');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);

	public $hasMany = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'customer_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'BillingAddress' => array(
			'className' => 'Address',
			'foreignKey' => 'customer_id',
			'dependent' => false,
			'conditions' => array('BillingAddress.type' => BILLING),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'DeliveryAddress' => array(
			'className' => 'Address',
			'foreignKey' => 'customer_id',
			'dependent' => false,
			'conditions' => array('DeliveryAddress.type' => DELIVERY),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public $hasAndBelongsToMany = array(
		'Product' => array(
			'className' => 'Product',
			'joinTable' => 'wishlists',
			'foreignKey' => 'customer_id',
			'associationForeignKey' => 'product_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

	/**
	 * Returns the validation error messages for the registration/login form
	 *
	 * @return array An array of error messages with the field as key eg: [fieldName] => error_message
	 *
	 **/
	public function getAllValidationErrors()
	{
		$merchantErrors = $this->validationErrors;
		$shopErrors     = $this->Shop->validationErrors;
		$userErrors     = $this->User->validationErrors;

		$registerFormErrors = array();

		// first we put in all the validation errors of the current model
		foreach ($merchantErrors as $fieldName => $err) {
			if (!is_array($err)) {
				$registerFormErrors[$fieldName] = $err;
			}
		}

		// then we put in the validation errors of the associated models
		return array_merge($registerFormErrors, $shopErrors, $userErrors);
	}

	public function signupNewAccount($data = NULL) {
		$data['User']['group_id'] = CUSTOMERS;
		
		return $this->saveAll($data, array('validate'=>'first'));
	}
	
	public function signupNewAccountDuringCheckout($data = NULL) {
		$data['User']['group_id'] = CUSTOMERS;
		
		// this is to ensure that ONLY customer related data is created here.
		// we also want the BillingAddress and DeliveryAddress properly saved to database
		foreach ($data as $key => $value) {
			if ($key != 'User' AND $key != 'Customer' AND $key != '_Token'
			    AND $key != 'BillingAddress' AND $key != 'DeliveryAddress') {
				unset($data[$key]);
			}
		}
		return $this->saveAll($data, array('validate'=>'first'));
	}
	
	public function getExistingByShopIdAndEmail($data = NULL) {
		
		$this->recursive = -1;
		$this->User->recursive = -1;
		$this->Behaviors->load('Linkable.Linkable');
		$this->User->Behaviors->attach('Linkable.Linkable');
		
		$customer = $this->find('first', array('conditions'=>array('Customer.shop_id'=>$data['Customer']['shop_id'],
							       'User.email'=>$data['User']['email'],
							       'User.group_id'=>CUSTOMERS),
						       'link'=>array('User'),
						       'fields'=>'Customer.id'));
		
		if (empty($customer['Customer']['id'])) {
			return false;
		}
		$this->id = $customer['Customer']['id'];
		return $customer['Customer']['id'];
	}
		
	public function getExistingBillingAddress($data = NULL) {
		
		return $this->getExistingAddress($data, BILLING);
		
	}
	
	public function getExistingDeliveryAddress($data = NULL) {
		
		return $this->getExistingAddress($data, DELIVERY);
		
	}
	
	public function duplicateBillingAddressFromDeliveryAddress($deliveryAddressId) {
		$deliveryAddress = $this->DeliveryAddress->read(null, $deliveryAddressId);
		
		// unset the id
		unset($deliveryAddress['DeliveryAddress']['id']);
		
		$inputArray = array('BillingAddress'=>array());
		
		$inputArray['BillingAddress'][] = $deliveryAddress['DeliveryAddress'];
		$inputArray['BillingAddress'][0]['type'] = BILLING;
		
		$billingAddressId = $this->getExistingAddress($deliveryAddress, BILLING);
		
		if (!($billingAddressId > 0)) {
			
			$this->setNewAddress($inputArray, BILLING);
			$billingAddressId = $this->BillingAddress->id;
			
		}
		
		return $billingAddressId;
	}
	
	private function getExistingAddress($data = NULL, $type = BILLING) {
		
		if ($type == BILLING) {
			$modelName = 'BillingAddress';
			$model = $this->BillingAddress;
		} elseif ($type == DELIVERY) {
			$modelName = 'DeliveryAddress';
			$model = $this->DeliveryAddress;
		} else {
			return false;
		}
		
		if (empty($data[$modelName])) {
			return false;
		}
		
		$conditions = array();
		
		
		
		foreach($data[$modelName][0] as $field => $value) {
			$newKey = $modelName . '.' . $field;
			$conditions[$newKey] = $value;
		}
		
		$conditions[$modelName . '.customer_id'] = $this->id;
		
		$address = $model->find('first', array('conditions'=>$conditions,
						       'fields'=>$modelName . '.id'));	
		
		if (empty($address)) {
			return false;
		}
		
		return $address[$modelName]['id'];
		
	}
	
	public function setNewBillingAddress($data = NULL) {
		return $this->setNewAddress($data, BILLING);
	}
	public function setNewDeliveryAddress($data = NULL) {
		return $this->setNewAddress($data, DELIVERY);
	}
	
	private function setNewAddress($data = NULL, $type = BILLING) {
		
		if ($type == BILLING) {
			$modelName = 'BillingAddress';
			$model = $this->BillingAddress;
		} elseif ($type == DELIVERY) {
			$modelName = 'DeliveryAddress';
			$model = $this->DeliveryAddress;
		} else {
			return false;
		}
		
		$addressData = array();
		
		if (!empty($data[$modelName][0]) AND is_array($data[$modelName][0])) {
			$data[$modelName][0]['customer_id'] = $this->id;
			$addressData[$modelName] = $data[$modelName][0];
		} elseif (!empty($data[$modelName]) AND is_array($data[$modelName])) {
			$data[$modelName]['customer_id'] = $this->id;
			$addressData[$modelName] = $data[$modelName];
		} else {
			return false;
		}
		
		return $model->save($addressData);
	}
	

}
?>