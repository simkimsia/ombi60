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
			'conditions' => '',
			'fields' => '',
			'order' => ''
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

	/**
	*
	* For registering a new Customer
	*
	* @param array $data Form data from register form
	* @return boolean Return true if successful. False otherwise.
	*
	**/
	public function signupNewAccount($data = NULL) {
		$data['User']['group_id'] = CUSTOMERS;
		
		return $this->saveAll($data, array('validate'=>'first'));
	}
	
	/**
	*
	* Take in order form data at checkout process and create a brand new Customer User
	* Works exclusively with checkout process
	*
	* @param array $data 
	* @return boolean Returns true if successful. False otherwise.
	**/
	public function signupNewAccountDuringCheckout($data = NULL) {
		
		// extracting all the various pieces of data from address and forming a 
		// User data array before we create
		// we need to have a fullname for the user, so we take it from the billing address
		$data['User']['full_name'] = $data['BillingAddress'][0]['full_name'];
		$data['User']['name_to_call'] = $data['BillingAddress'][0]['full_name'];
		
		// because we need to create brand new User so we need to create random password
		App::uses('StringLib', 'UtilityLib.Lib');
		App::uses('AuthComponent', 'Controller/Component');
		$data['User']['password'] = AuthComponent::password(StringLib::generateRandom());
		
		// hackish code to pass the shop id into the uniqueEmailInShop validator
		// read first few lines of uniqueEmailInShop method in User model
		$data['User']['shop_id'] 		= $data['Order']['shop_id'];
		$data['Customer']['shop_id'] 	= $data['Order']['shop_id'];
		
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
	
	/**
	*
	* Retrieve any existing Customer based on shop id and email inside order form
	* Works exclusively with checkout process
	* 
	* @param array $orderFormData Order form data has shop id in $data['Order']['shop_id'] and $data['User']['email']
	* @return integer Returns the id of the Customer if exists, otherwise returns false
	**/
	public function getExistingByShopIdAndEmail($orderFormData = NULL) {
		
		$this->Behaviors->load('Linkable.Linkable');

		if (isset($orderFormData['Order']['shop_id'])) {
			$shopId = $orderFormData['Order']['shop_id'];
		}
		
		if (isset($orderFormData['User']['email'])) {
			$userEmail = $orderFormData['User']['email'];
		}
		
		$customer = $this->find('first', array(
			'conditions'=>array(
				'Customer.shop_id'=>$shopId,
				'User.email'=>$userEmail,
				'User.group_id'=>CUSTOMERS
			),
			'link'=>array('User'),
			'fields'=>'Customer.id'
		));
		
		if (empty($customer['Customer']['id'])) {
			return false;
		}
		
		$this->id = $customer['Customer']['id'];
		return $customer['Customer']['id'];
	}
	
	/**
	* 
	* Gets 	all the existing Billing Address that this Customer has and matches the data array.
	* ALias for getExistingAddress($data, BILLING)
	*
	* @param array $data Data array which contains information like region, city, address, etc
	* @return integer Returns the address id if successful. False otherwise.
	**/
	public function getExistingBillingAddress($data = NULL) {
		
		return $this->getExistingAddress($data, BILLING);
		
	}
	
	/**
	* 
	* Gets all the existing Delivery Address that this Customer has and matches the data array
	* ALias for getExistingAddress($data, DELIVERY)
	*
	* @param array $data Data array which contains information like region, city, address, etc
	* @return integer Returns the address id if successful. False otherwise.
	**/	
	public function getExistingDeliveryAddress($data = NULL) {
		
		return $this->getExistingAddress($data, DELIVERY);
		
	}
		
	/**
	* 
	* Gets all the existing Address that this Customer has and matches the data array and type.
	*
	* @param array $data Data array which contains information like region, city, address, etc
	* @param integer $type Either BILLING or DELIVERY
	* @return integer Returns the address id if successful. False otherwise.
	**/	
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
	
	/**
	*
	* Alias for setNewAddress($data, BILLING)
	* @param array $data
	* @return integer Returns the new address id if successful. Otherwise, returns false
	**/
	public function setNewBillingAddress($data = NULL) {
		return $this->setNewAddress($data, BILLING);
	}
	
	/**
	*
	* Alias for setNewAddress($data, DELIVERY)
	* @param array $data
	* @return integer Returns the new address id if successful. Otherwise, returns false
	**/	
	public function setNewDeliveryAddress($data = NULL) {
		return $this->setNewAddress($data, DELIVERY);
	}
	
	/**
	*
	* Returns the new Address id when we create a new address associated with current Customer
	*
	* @param array $data 
	* @param integer $type Either BILLING or DELIVERY 
	* @return integer Returns the new address id if successful. Otherwise, returns false
	**/
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
		
		// doubly ensure that the type is correctly saved!!!
		$addressData[$modelName]['type'] = $type;
		
		$result = $model->save($addressData);
		if ($result  == false) { return false; }
		return $model->id;
	}	

}
?>