<?php
class Order extends AppModel {

	public $name = 'Order';
	
	public $actsAs = array('Filter.Filter');

	public $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BillingAddress' => array(
			'className' => 'Address',
			'foreignKey' => 'billing_address_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DeliveryAddress' => array(
			'className' => 'Address',
			'foreignKey' => 'delivery_address_id',
		
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cart' => array(
			'className' => 'Cart',
			'foreignKey' => 'cart_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	
	
	public $hasMany = array(
		'OrderLineItem' => array(
			'className' => 'OrderLineItem',
			'foreignKey' => 'order_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Payment' => array(
			'className' => 'Payment',
			'foreignKey' => 'order_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Shipment' => array(
			'className' => 'Shipment',
			'foreignKey' => 'order_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	/**
	 * this is a very specific operation where it converts the Cart data
	 * into savable data array
	 *
	 * it assumes $productsInCart is in this format
	 * array([product_id] => quantity_ordered)
	 *
	 * $options is in this format
	 * array([shop_id] => compulsory_value,
	 * 	 [customer_id] => compulsory_value,
	 * 	 [billing_address_id] => compulsory_value,
	 * 	 [delivery_address_id] => compulsory_value,
	 * 	 [amount] => compulsory_value
	 * 	 [order_no] => optional_value,)
	 **/
	public function convertCart($cartData, $options = array()) {
		
		$defaultOptions = array('customer_id' => 0,
					'billing_address_id' => 0,
					'delivery_address_id' => 0,
					'amount' => 0,
					'order_no' => '',
					'contact_email' => '');
		
		$options = array_merge($defaultOptions, $options);
		if (!is_array($cartData) OR empty($cartData)) {
			return false;
		}
		
		// we need to remove the id from the cart items otherwise they will override the legit
		// order line items
		$shipping_required = false;
		foreach($cartData['CartItem'] as $key => $cartItem) {
			unset($cartData['CartItem'][$key]['id']);
			$shipping_required = $shipping_required || $cartData['CartItem'][$key]['shipping_required'];
		}
		
		// initial data
		$data = array('Order' => array( 'shop_id' => $options['shop_id'],
						'customer_id' => $options['customer_id'],
						'billing_address_id' => $options['billing_address_id'],
						'delivery_address_id' => $options['delivery_address_id'],
						'order_no' => $options['order_no'],
						'cart_id' => $cartData['Cart']['id'],
						'contact_email' => $options['contact_email'],
						),
			      'OrderLineItem' => $cartData['CartItem']);
		
		// put in cart data such as shipping weight, etc
		$data['Order']['amount'] = $cartData['Cart']['amount'];
		$data['Order']['total_weight'] = $cartData['Cart']['total_weight'];
		$data['Order']['shipped_weight'] = $cartData['Cart']['shipped_weight'];
		$data['Order']['shipped_amount'] = $cartData['Cart']['shipped_amount'];
		$data['Order']['shipping_required'] = $shipping_required;
		
		$data['Order']['currency'] = $cartData['Cart']['currency'];
		// to count the no. of order_line_item to fulfil
		$data['Order']['order_line_item_count'] = count($cartData['CartItem']);
		
		if ($data['Order']['amount'] >= 0 AND !empty($data['OrderLineItem'])) {
			return $data;
		}
		return false;
	}
	
	public function removeCart($cart_id) {
		$cart = ClassRegistry::init('Cart'); 
		return $cart->delete($cart_id);
	}
	
	
	public function beforeSave() {
		
		// for brand new orders we want to create unique hash
		if (empty($this->data['Order']['id']) AND empty($this->id)) {
			$plain = 'Shop_' . $this->data['Order']['shop_id'] .
				 'Customer_' . $this->data['Order']['customer_id'] .
				 'OrderNo_' . $this->data['Order']['order_no'] . time();
			
			$this->data['Order']['hash'] = Security::hash($plain, 'sha1', true);
			
			
			if (empty($this->data['Order']['order_no'])) {
				$this->data['Order']['order_no'] = $this->getNextOrderNo();	
			}
						       
		}
		
		/**
		 * to prevent editing of orders past the checkout point
		 
		$id = 0;
		if (isset($this->data[$this->alias]['id'])) {
			$id = $this->data[$this->alias]['id'];	
		}
		if ($id > 0) {
			
			return !($this->field('past_checkout_point', array('id'=>$id)));
			
		}
		**/
		return true;
	}
	
	private function getNextOrderNo() {
		$shopId = $this->data['Order']['shop_id'];
		$order_no = $this->field('order_no', array('shop_id'=>$shopId), 'order_no DESC');
		if (!$order_no) {
			return '1001';
		}
		return strVal(intVal($order_no) + 1);
	}
	
	public function getDetailed($id, $lineItems = true) {
		if (!$id) {
			return false;
		}
		
		$this->recursive = -1;
		$this->DeliveryAddress->recursive = -1;
		$this->BillingAddress->recursive = -1;
		$this->Payment->recursive = -1;
		$this->Shipment->recursive = -1;
		
		
		// attach Linkable behavior
		$this->Behaviors->load('Linkable.Linkable');
		$this->Customer->Behaviors->attach('Linkable.Linkable');
		$this->Customer->User->Behaviors->attach('Linkable.Linkable');
		$this->DeliveryAddress->Behaviors->attach('Linkable.Linkable');
		$this->BillingAddress->Behaviors->attach('Linkable.Linkable');
		$this->Payment->Behaviors->attach('Containable');
		$this->Shipment->Behaviors->attach('Containable');
		
		$findConditionsArray = 	array(
						'conditions'=>array('Order.id'=>$id),
						'link'=>array('Customer'=>array('User'),
							      'DeliveryAddress',
							      'BillingAddress',),
						'contain'=>array('Payment', 'Shipment')
						  );
		
		if ($lineItems) {
			
			$this->OrderLineItem->recursive = -1;
			$this->OrderLineItem->Behaviors->attach('Containable');
			$this->Behaviors->load('Containable');
			
			$findConditionsArray['contain'][] = 'OrderLineItem';
			
		}
		
		$order = $this->find('first', $findConditionsArray);
		
		return $order;
	}
	
	public function getShippingRequired($id = false) {
		if (!$id) {
			return false;
		}
		$shippingRequired = false;
		$this->OrderLineItem->recursive = -1;
		$items = $this->OrderLineItem->find('all', array('conditions'=>array('OrderLineItem.order_id'=>$id),
								 'fields'=>array('OrderLineItem.shipping_required', 'OrderLineItem.id')));
		
		if (!empty($items)) {
			
			foreach($items['OrderLineItem'] as $item) {
				$shippingRequired = $item['shipping_required'];
				if ($shippingRequired) {
					break;
				}
			}
			
		}
		
		return $shippingRequired;
		
	}

	
	public function afterSave($created) {
		if ($created) {
			$this->Customer->User->Cart->id = $this->data['Order']['cart_id'];
			$this->Customer->User->Cart->saveField('order_id', $this->id);
		}
	}
	
	public function saveForCheckoutStep1($data) {
		
		$result = $this->saveAll($data);
		if ($result) {
			
			$hash = $this->field('hash', array('id'=>$this->id));
			return array('result'=>$result, 'hash'=>$hash);
		}
		
		return $result;
		
	}
	
	public function savePaymentAndShipment($data) {
		// assume $data contains order_id for the Payment and Shipment arrays
		// assume $data contains ShippingRate id
		// assume $data is in the form array('Payment'=>array('payment_module_id'=>3),) etc
		// we need to convert the $data to this format array('Payment'=>array(array('payment_module_id'=>3),)) etc
		
		// set the Order pk
		$data['Order'] = array('id'     => $this->id,
				       'status' => $data['Order']['status'],
				       'payment_status' => $data['Payment']['status'],);
		
		// check for Shipment
		if (array_key_exists('Shipment', $data)) {
			if (array_key_exists('ShippingRate', $data)) {
				$rate = array('ShippingRate' => $data['ShippingRate']);
			} else {
				$rate = $this->Shop->ShippedToCountry->ShippingRate->read(null, $data['Shipment']['shipping_rate_id']);	
			}
			
			$data['Shipment']['name'] = $rate['ShippingRate']['name'];
			$data['Shipment']['description'] = $rate['ShippingRate']['description'];
			$data['Shipment']['price'] = $rate['ShippingRate']['price'];
			
			$actualShipmentData = array(0=>$data['Shipment']);
			$data['Shipment']  = $actualShipmentData;
		}
		
		$actualPaymentData = array(0=>$data['Payment']);
		$data['Payment']  = $actualPaymentData;
		
		// need to set Order past_checkout_point to be true to conclude the order
		$data['Order']['past_checkout_point'] = true;
		
		$dataSource = $this->getDataSource();
		
		$dataSource->begin($this);
		
		$result = $this->saveAll($data, array('atomic'=>false));
		
		if (!$result) {
			$dataSource->rollback($this);
			return false;
		}
		
		// because Paypal_Payers_Payment not a direct associated with Order so we need to save it separately
		if (isset($data['PaypalPayersPayment'])) {
			$pppData = array('PaypalPayersPayment' => $data['PaypalPayersPayment']);
			$pppData['PaypalPayersPayment']['payment_id'] = $this->Payment->id;
			
			$result = $this->Payment->PaypalPayersPayment->save($pppData);
			
			if (!$result) {
				$dataSource->rollback($this);
				return false;
			}
			
		}
		
		// need to set Cart past_checkout_point to true to ensure cart is emptied
		$cartData = array('Cart' => $data['Cart']);
		$cartData['Cart']['past_checkout_point'] = true;
		$result = $this->Cart->save($cartData, array('validate'=>false));
		
		if (!$result) {
			$dataSource->rollback($this);
			return false;
		} else {
			$dataSource->commit($this);
			return true;
		}
		
	}
	
	public function updatePrices($id = false, $cartData = array()) {
		$this->id = $id;
		
		if (!$this->id) {
			return false;
		}
		
		
		if (!is_array($cartData) OR empty($cartData)) {
			return false;
		}
		
		// get all items of this cart especially their id, product_id, quantity
		$items = $this->OrderLineItem->find('all',
			    array('conditions' => array(
							'OrderLineItem.order_id' => $this->id
						    ),
				  'fields' => array('OrderLineItem.id',
						    'OrderLineItem.product_id')
			));
		
		
		// order line items
		
		foreach($items as $key1 => $item) {
			foreach($cartData['CartItem'] as $key => $cartItem) {
				if ($item['OrderLineItem']['product_id'] === $cartItem['product_id']) {
					$cartItem['id'] = $item['OrderLineItem']['id'];
					unset($cartItem['cart_id']);
					
					$items['OrderLineItem'][$key1] = $cartItem;
					
					unset($cartData['CartItem'][$key]);
					unset($items[$key1]);
					break;
				
				}
			}
			
		}
		
		
		// initial data
		$data = array('Order' => array( 'id' => $this->id,
						'cart_id' => $cartData['Cart']['id']
						),
			      'OrderLineItem' => $items['OrderLineItem']);
		
		// put in cart data such as shipping weight, etc
		$data['Order']['amount'] = $cartData['Cart']['amount'];
		$data['Order']['total_weight'] = $cartData['Cart']['total_weight'];
		$data['Order']['shipped_weight'] = $cartData['Cart']['shipped_weight'];
		$data['Order']['shipped_amount'] = $cartData['Cart']['shipped_amount'];
		$data['Order']['shipping_required'] = $cartData['Cart']['shipping_required'];
		
		$data['Order']['currency'] = $cartData['Cart']['currency'];
		
		
		if (!empty($data['OrderLineItem'])) {
			$result = $this->saveAll($data);
			if (!$result) {
				
				return $result;
			} else {
				
				return $data;	
			}
			
		}
		
		return false;
	
	}
	
	/**
	*
	* we will expect form data to contain information on customer id, billing address,
	* delivery address, cart data and create a order marked as 'Abandoned'
	*
	* @param array $orderFormData 
	* @return string Order id in UUID format
	**/
	public function createFrom($orderFormData = array()) {
		return '11111111-1111-1111-1111-111111111111';
	}
	
	/**
	*
	* if the request data contains ['Order']['customer_id']
	* return ['Order']['customer_id']
	* otherwise we look up database for existing customer id based on email and shop_id
	* worst case scenario we return false.
	*
	* @param array $orderFormData The request data submitted at CartsController/create_order action
	* @return integer $customer_id Customer id
	**/
	public function getCustomerIdFrom($orderFormData = array()) {
		// this chunk of if-else statement is to determine customer id
		if ($orderFormData['Order']['customer_id'] > 0) {
			return $orderFormData['Order']['customer_id'];
		} else {
			// check database for existing customer
			return $this->Customer->getExistingByShopIdAndEmail($this->request->data);
		}
	}
	
	/**
	* 
	* Checks order form data whether delivery address is to be the same as billing.
	* If so, copies billing address data for delivery address data.
	* Returns the order form data
	*
	* @param array $orderFormData 
	* @return array Returns the $orderFormData with added information on delivery address
	**/
	public function makeDeliveryBillingAddressesSameIn($orderFormData = array()) {
		if ($orderFormData['DeliveryAddress']['same']) {
			$orderFormData['DeliveryAddress'] = $orderFormData['BillingAddress'];
			$orderFormData['DeliveryAddress'][0]['type'] = DELIVERY;
		}
		
		return $orderFormData;
	}
	
	/**
	*
	* synchronize Billing and Delivery Addresses
	*
	* @param array $options Array containing options such as
	* @return boolean Returns true if synchronize works
	*
	**/
	public function syncAddressCustomerOrder($options = array()) {
		// $customerId, $shopId, $hash,
		$customerId = $options['customer_id'];
		$shopId = $options['shop_id'];
		$hash = $options['hash'];
		
		$delivery_address_id = isset($options['delivery_address_id']) ? $options['delivery_address_id'] : 0;
		
		$result = true;
		
		// instantiate the Cart model
		$cart = $this->Order->Customer->User->Cart;
		
		$customerId = $this->getCustomerIdFrom($this->request->data);
		
		// use existing delivery address
		if ($delivery_address_id > 0) {
			$deliveryAddressId = $delivery_address_id;
			$this->Order->Customer->id = $customerId;
			// we go retrieve the delivery address and use its details for billing address
			$billingAddressId = $this->Order->Customer->duplicateBillingAddressFromDeliveryAddress($delivery_address_id);
			
			if (!($deliveryAddressId > 0) OR !($billingAddressId > 0) OR !($customerId >0)) {
				$result = false;
			}
			
		} else {
			
			// duplicate the delivery address if same as billing address
			$this->request->data = $this->makeDeliveryBillingAddressesSameIn($this->request->data);
			
			
			
			// if customer is existing in database
			if ($customerId){
				// retrieve addresses from database	
				$billingAddressId = $this->Order->Customer->getExistingBillingAddress($this->request->data);
				
				$deliveryAddressId = $this->Order->Customer->getExistingDeliveryAddress($this->request->data);
				
				// if billing address does not exist in database, we will create new billing address
				if (!$billingAddressId) {
					
					if ($this->Order->Customer->setNewBillingAddress($this->request->data)) {
						$billingAddressId = $this->Order->Customer->BillingAddress->id;
					} else {
						$result = false;
					}
				}
				
				// if delivery address does not exist in database, we will create new delivery address
				if (!$deliveryAddressId AND $billingAddressId) {
					if ($this->Order->Customer->setNewDeliveryAddress($this->request->data)) {
						$deliveryAddressId = $this->Order->Customer->DeliveryAddress->id;
					} else {
						$result = false;
					}
				}
				
				
				
			} else {
				// we need to have a fullname for the user, so we take it from the billing address
				$this->request->data['User']['full_name'] = $this->request->data['BillingAddress'][0]['full_name'];
				$this->request->data['User']['name_to_call'] = $this->request->data['BillingAddress'][0]['full_name'];
				// because we need to create brand new User so we need to create random password
				$this->request->data['User']['password'] = AuthComponent::password($this->RandomString->generate());
				// hackish code to pass the shop id into the uniqueEmailInShop validator
				// read first few lines of uniqueEmailInShop method in User model
				$this->request->data['User']['shop_id'] = $this->request->data['Customer']['shop_id'];
				
				$result = $this->Order->Customer->signupNewAccountDuringCheckout($this->request->data);
				$customerId = $this->Order->Customer->id;
				$billingAddressId = $this->Order->Customer->BillingAddress->field('id');
				$deliveryAddressId = $this->Order->Customer->DeliveryAddress->field('id');
				
			}	
		}
		
		// if at this point in time, we get a $result == false, it means something went wrong prior.
		if (!$result) {
			$this->Session->setFlash(__('The Order could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			
		} else {
		
			// since all prepartory work is done, we can now start to save Order data.
			$orderDetails = array();
			
			// store shop and customer ids
			$orderDetails['shop_id']     = $shopId;
			$orderDetails['customer_id'] = $customerId;
	
			// store the addresses id
			$orderDetails['billing_address_id']  = $billingAddressId;
			$orderDetails['delivery_address_id'] = $deliveryAddressId;
			
			// we fix the contact email on the order based on the email supplied in the form.
			$orderDetails['contact_email'] = (isset($this->request->data['User']['email'])) ? $this->request->data['User']['email'] : '';
				
			// now we get the cart data again
			$cartData = $cart->findByHash($hash);
			
			$orderDetails['amount'] = $cartData['Cart']['amount'];
			
			// convert the cart data to savable order data
			$data = $this->Order->convertCart($cartData, $orderDetails);
			
			// now we save the order for the very first time!
			$resultSet = 	$this->Order->saveForCheckoutStep1($data);
			
			if (is_array($resultSet) AND $resultSet['result']) {
				// reconsider removing the cart data.
				// incase user press back button to change address etc.
				// or halfway user gets DC.
				//$this->Order->removeCart($cartData['Cart']['id']);
				
				$orderHash = $resultSet['hash'];
				
				// need PayPalRequest to call DoExpressCheckout API
				$this->Session->write('Shop.' . $shopId . '.confirmPage', array('PayPalRequest'=>$PayPalRequest,
												'hash'=>$orderHash,
												'amount'=>$orderDetails['amount'],
												'shipped_amount'=>$data['Order']['shipped_amount'],
												'shipped_weight'=>$data['Order']['shipped_weight'],
												'shipping_required'=>$data['Order']['shipping_required'],
												'paypal_payer_id' => $paypalPayerId));
				
				$this->redirect(array('action' => 'pay',
						      'controller' => 'orders',
						      'hash' => $orderHash,
						      'shop_id' => $shopId));
				
				$this->Session->setFlash(__('The Order has been saved'), 'default', array('class'=>'flash_success'));
				
			} else {
				$this->Session->setFlash(__('The Order could not be saved. Please, try again.'), 'default', array('class'=>'flash_failure'));
			}
			
		}
		
	}
	
	

}
?>