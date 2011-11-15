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
	
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->virtualFields['shipping_required'] = sprintf('(%s.shipped_weight > 0)', $this->alias, $this->alias);
		$this->virtualFields['net_amount'] = sprintf('(%s.shipping_fee + %s.amount)', $this->alias, $this->alias);
	}
	
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
	

	/**
	*
	* beforeSave Filter
	* Add in the order_no for newly created order
	*
	**/
	public function beforeSave() {
		/**
		* Need to generate order_no unique to the shop itself
		**/
		if (empty($this->data['Order']['id']) && empty($this->id)) {
			if (empty($this->data['Order']['order_no'])) {
				$this->data['Order']['order_no'] = $this->getNextOrderNo();        
	        }
		}
		
		return true;
	}
	
	private function getNextOrderNo() {
		$shopId = $this->data['Order']['shop_id'];
		$order_no = $this->field('order_no', array('shop_id'=>$shopId), 'order_no DESC');
		if (!$order_no) {
			return '10001';
		}
		return strVal(intVal($order_no) + 1);
	}
	
	/**
	*
	* Get detailed Order model data alongside with Customer, Delivery Address, Billing Address,
	* Payment, Shipment
	*
	* @param string $id Order id
	* @param boolean $lineItems Default true.
	* @return array Data array
	**/
	public function getDetailed($id, $lineItems = true) {
		if (!$id) {
			return false;
		}

		$this->unbindModel(array(
			'belongsTo' => array(
				'Shop',
				'Cart',
			)
		));
		
		$this->bindModel(array(
			'belongsTo' => array(
				'User' => array(
					'className' => 'User',
					'foreignKey' => false,
					'conditions' => array(
						'Customer.user_id = User.id'
					)
				
				)
			)
		));
		
		if (!$lineItems) {
			$this->unbindModel(array(
				'hasMany' => array(
					'OrderLineItem',
				)
			));	
			
		}

		$this->recursive = 1;
		
		$findConditionsArray = array(
			'conditions'=>array('Order.id'=>$id),
		);
		
		$order = $this->find('first', $findConditionsArray);

		return $order;
	}
	
	
	/**
	*
	* Returns a result array containing Shipment data formatted from ShippingRate data
	* The result array  is used to complete checkout process
	*
	* @param array $data
	* @return array Returns the formatted array if successful. Otherwise, false
	*
	**/
	public function extractShipmentDataFromShippingRate($data) {
		if (array_key_exists('ShippingRate', $data)) {
			$result = array('Shipment'=>array());
			$result['Shipment']['shipping_rate_id']	= $data['ShippingRate']['id'];
			$result['Shipment']['name'] 			= $data['ShippingRate']['name'];
			$result['Shipment']['description'] 		= $data['ShippingRate']['description'];
			$result['Shipment']['price'] 			= $data['ShippingRate']['price'];
			return $result;
		}
		return false;
	}
	
	/**
	*
	* close the cart
	* save Payment and Shipment data 
	* transfer the final shipping amount, prices, cart item prices, weights into order_line_items
	*
	* @param array $data the prepared data to complete the purchase
	* @return boolean Returns true if successful. False otherwise
	*
	**/
	public function completePurchase($data) {
		
		// set the Order pk
		$data['Order'] = array(
			'id'     => $this->id,
			'status' => ORDER_OPENED,
		);
		
		
		// need to set Order past_checkout_point to be true to conclude the order
		$data['Order']['past_checkout_point'] = true;
		
		$dataSource = $this->getDataSource();
		
		$dataSource->begin($this);
		
		$result = $this->saveAssociated($data, array('atomic'=>false));
		
		if (!$result) {

			$dataSource->rollback($this);
			return false;
		}


		// get cart id
		$cartId = $this->field('cart_id');
		$this->Cart->id = $cartId;

		// need to set Cart past_checkout_point to true to ensure cart is emptied
		$result = $this->Cart->close($cartId);
		
		if (!$result) {

			$dataSource->rollback($this);
			return false;
		}
		
		
		// check that the key data for both Cart and Order match
		$result = $this->confirmMatchWithCart($this->id, $cartId);
		
		if (!$result) {
			$dataSource->rollback($this);
			return false;
		} else {
			$dataSource->commit($this);
			return true;
		}
		
	}
	
	/**
	* check that the key data for both Cart and Order match
	* we will recalculate the prices for both 
	*
	* 
	**/
	public function confirmMatchWithCart($orderId, $cartId) {
		// get the Cart and Items
		$cart = $this->Cart->find('first', array(
			'conditions' => array('Cart.id' => $cartId),
			'contain'	=> array('CartItem')
		));
		
		// get the Order and Items
		$order = $this->find('first', array(
			'conditions' => array('Order.id' => $orderId),
			'contain'	=> array('OrderLineItem')
		));
		
		// check the Order and Cart model data first
		$result = $this->checkImportantFieldsMatchForOrderCart($order, $cart);
		
		if (!$result) {
			return false;
		}
		
		// THEN we check the individual items
		return $this->checkItemsMatchForOrderCart($order, $cart);
		
	}
	
	
	/**
	*
	* check through main model for values matching
	*
	* @param array $order Should contain Order indexed array
	* @param array $cart SHould contain Cart indexed array
	* @return boolean Return true if successful, false otherwise
	**/
	protected function checkItemsMatchForOrderCart($order, $cart) {
		$order = $order['OrderLineItem'];
		$cart = $cart['CartItem'];
		if (count($order) != count($cart)) {
			return false;
		}
		
		$orderItems = Set::combine($order, '{n}.variant_id', '{n}');
		$cartItems = Set::combine($cart, '{n}.variant_id', '{n}');
		
		$fieldsNotImportant = array(
			'created', 'cart_id', 'order_id',
			'modified', 'status',
			'id', );
			
		foreach($orderItems as $variant_id=>$item) {
			foreach ($item as $field => $value) {
				if (!in_array($field, $fieldsNotImportant)) {
					if ($cartItems[$variant_id][$field] != $value) {
						return false;
					}
				}				
			}
		}
		
		return true;
	}
	
	/**
	*
	* check through main model for values matching
	*
	* @param array $order Should contain Order indexed array
	* @param array $cart SHould contain Cart indexed array
	* @return boolean Return true if successful, false otherwise
	**/
	protected function checkImportantFieldsMatchForOrderCart($order, $cart) {
		$order = $order['Order'];
		$cart = $cart['Cart'];
		if ($order['cart_id'] != $cart['id']) {
			return false;
		}
		
		if ($order['order_line_item_count'] != $cart['cart_item_count']) {
			return false;
		}
		
		$fieldsNotImportant = array(
			'created', 'cart_id',
			'modified', 'billing_address_id', 'delivery_address_id',
			'id', 'customer_id', 'delivered_to_country',
			'previous_price', 'order_no', 'contact_email',
			'previous_currency', 'payment_status', 'fulfillment_status',
			'net_amount', 'shipping_fee', 'status',
			'cart_item_count', 'order_line_item_count');


		foreach($order as $field=>$value) {
			if (!in_array($field, $fieldsNotImportant)) {
				if ($cart[$field] != $value) {
					return false;
				}
			}
		}
		
		return true;
	}
	
	/**
	*
	* Read all the OrderLineItem and recalculate Total weight, price, etc
	*
	* @param string $orderId Order id
	* @return boolean Returns true if successful. False otherwise.
	**/
	public function recalculateTotalWeightPrice($orderId) {
		// get all items of this cart 
		$this->OrderLineItem->recursive = -1;
		$items = $this->OrderLineItem->find('all',
			array(
				'conditions' => array(
					'OrderLineItem.order_id' => $orderId,
					'OrderLineItem.product_quantity >=' => 1,
				)
			)
		);
		
		$shippedWeight 		= 0;
		$totalWeight		= 0;
		$totalAmount		= 0.0;
		$shippedAmount 		= 0.0;
		$currency			= '';
		
		// go through each item and calculate total weight and price
		foreach($items as $key => $item) {
			$quantity 	= $item['OrderLineItem']['product_quantity'];
			$weight		= $item['OrderLineItem']['product_weight'];
			$price		= $item['OrderLineItem']['product_price'];
			$currency	= $item['OrderLineItem']['currency'];
			
			$lineWeight = $quantity * $weight;
			$linePrice	= $quantity * $price;
			
			if ($item['OrderLineItem']['shipping_required']) {
				$shippedWeight += $lineWeight;
				$shippedAmount += $linePrice;
			}
			
			$totalWeight += $lineWeight;
			$totalAmount += $linePrice;
		}
		
		// prepare the data to be saved
		$this->id = $orderId;
		$orderData = array(
			'Order' => array(
				'amount' 			=> $totalAmount,
				'shipped_amount'	=> $shippedAmount,
				'total_weight'		=> $totalWeight,
				'shipped_weight'	=> $shippedWeight,
				'currency'			=> $currency
			)
		);
		
		// execute the save function and return its results
		return $this->save($orderData);
	}
				
	/**
	*
	* We will expect form data from checkout process first page aka CartsController/view
	* It is expected that CartsController/create_order will call this function.
	*
	* @param array $orderFormData 
	* @return string Order id in UUID format
	**/
	public function createFrom($orderFormData = array()) {
		
		//3 steps of NEW Order creation
		// Step 1) Resolve the Customer Id, the Billing and Delivery Address id and contact_email
		// Step 2) Fetch all Cart data and CartItem data and use them as Order and OrderLineItem data
		// Step 3) Clean up Order, OrderLineItem data before save. Eg, getting rid of ids for OrderLineItem data
		
		
		// We need to resolve the customer and address ids. Why??
		// Reason 1) We don't really know for sure 
		// if its a guest Customer or a Registered Customer at this point in time.
		// Reason 2) We also would like to reuse addresses where applicable so we run this resolve function
		// Customer id, billing address, delivery address, contact_email are all resolved after this step
		$orderFormData = $this->resolveCustomerAddressIDIn($orderFormData);
		
		// fetch Cart and CartItem data where quantity per CartItem is at least 1
		// based on the cart_id inside the $orderFormData
		$cartData = $this->Cart->find('first', array(
			'conditions'	=> array(
				'Cart.id' 	=> $orderFormData['Order']['cart_id']
			),
			'contain'		=> array(
				'CartItem' => array(
					'conditions' => array('CartItem.product_quantity >=' => 1)
				)
			)
		));
		
		// Cleaning up CartItem data before using it for creating new Order and OrderLineItem
		// we need to remove the id from the cart items otherwise they will override the legit
		// order line items
		foreach($cartData['CartItem'] as $key => $cartItem) {
			unset($cartData['CartItem'][$key]['id']);
		}
		
		// put in cart data such as shipping weight, etc
		$orderFormData['Order']['amount'] 			= $cartData['Cart']['amount'];
		$orderFormData['Order']['total_weight'] 	= $cartData['Cart']['total_weight'];
		$orderFormData['Order']['shipped_weight'] 	= $cartData['Cart']['shipped_weight'];
		$orderFormData['Order']['shipped_amount'] 	= $cartData['Cart']['shipped_amount'];
		$orderFormData['Order']['currency'] 		= $cartData['Cart']['currency'];
		
		
		// assigning Order data and OrderLineItem data
		$data = array(
			'Order' => $orderFormData['Order'],
			'OrderLineItem' => $cartData['CartItem']
		);
		
		// finally we create the new Order!!
		$this->create();
		$result = $this->saveAssociated($data);
		
		
		if (!$result) {
			return false;
		}
		
		return $this->getLastInsertId();
		//return '11111111-1111-1111-1111-111111111111';
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
	private function getCustomerIdFrom($orderFormData = array()) {
		// this chunk of if-else statement is to determine customer id
		if (!empty($orderFormData['Order']['customer_id'])) {
			return $orderFormData['Order']['customer_id'];
		} else {
			// check database for existing customer
			return $this->Customer->getExistingByShopIdAndEmail($orderFormData);
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
	private function makeDeliveryBillingAddressesSameIn($orderFormData = array()) {
		if ($orderFormData['DeliveryAddress']['same']) {
			$orderFormData['DeliveryAddress'] = $orderFormData['BillingAddress'];
			$orderFormData['DeliveryAddress'][0]['type'] = DELIVERY;
		}
		
		return $orderFormData;
	}
	
	/**
	*
	* Extract the delivery address country and insert into the Order Form Data
	**/
	private function markDeliveredToCountryInOrder($orderFormData) {

		if (!is_blank($orderFormData['DeliveryAddress'][0]['country'])) {

			$orderFormData['Order']['delivered_to_country'] = $orderFormData['DeliveryAddress'][0]['country'];
		}
		
		return $orderFormData;
	}
	
	
	/**
	*
	* Resolve the Customer id and  Billing and Delivery Addresses ids
	* inside the order form data for creating a new order
	*
	* @param array $orderFormData The request data from CartsController/create_order
	* @return array Returns $orderFormData with correct ids for Customer, Address. Otherwise, returns false
	*
	**/
	public function resolveCustomerAddressIDIn($orderFormData = array()) {
		
		$customerId = $this->getCustomerIdFrom($orderFormData);
		
		$buyingDoneByExistingCustomer 	= !empty($customerId);
		$buyingDoneByNewCustomer 		= !$buyingDoneByExistingCustomer;
		
		// if explicitly given different addresses for billing, delivery
		// then no change in $orderFormData
		$orderFormData = $this->makeDeliveryBillingAddressesSameIn($orderFormData);
		
		$orderFormData = $this->markDeliveredToCountryInOrder($orderFormData);
		
		if ($buyingDoneByExistingCustomer) {
			// need to set the id in Customer so that the Address related functions work
			$this->Customer->id = $customerId;
			
			$billingAddressId 			= $this->BillingAddress->getIdByData($orderFormData['BillingAddress'][0]); 
			$createNewBillingAddress 	= ($billingAddressId === false);
			
			$deliveryAddressId 			= $this->DeliveryAddress->getIdByData($orderFormData['DeliveryAddress'][0]); 
			$createNewDeliveryAddress 	= ($deliveryAddressId === false);
						
			if ($createNewBillingAddress) {
				$customer = $this->Customer->find('first', array('conditions' => array('Customer.id' => $customerId)));
				if (empty($customer['User']['full_name'])) { //Registered on checkout
					$customer['User']['full_name'] = $orderFormData['BillingAddress'][0]['full_name'];
					$customer['User']['name_to_call'] = $orderFormData['BillingAddress'][0]['full_name'];
					$this->Customer->User->save($customer);
				}
				$billingAddressId = $this->Customer->setNewBillingAddress($orderFormData);
			} 
			
			if ($createNewDeliveryAddress) {
				$deliveryAddressId = $this->Customer->setNewDeliveryAddress($orderFormData);
			} 			
			
		} elseif ($buyingDoneByNewCustomer) {
			// create brand new customer based on supplied address data
			$this->Customer->signupNewAccountDuringCheckout($orderFormData);
			//$orderFormData = $this->prepareNewCustomerDataIn($orderFormData);
			
			$customerId = $this->Customer->id;
			$billingAddressId = $this->Customer->BillingAddress->id;
			$deliveryAddressId = $this->Customer->DeliveryAddress->id;
			
			
		}
		
		// CONFIRM and RESOLVE the customer id
		$orderFormData['Order']['customer_id'] = $customerId;
		// CONFIRM and RESOLVE the address ids
		$orderFormData['Order']['billing_address_id']  = $billingAddressId;
		$orderFormData['Order']['delivery_address_id'] = $deliveryAddressId;
		
		
		// CONFIRM and RESOLVE the contact_email
		$orderFormData['Order']['contact_email'] = (isset($orderFormData['User']['email'])) ? $orderFormData['User']['email'] : '';
		
		return $orderFormData;
		
	}
	
	/**
	* 
	* Retrieve Order data with OrderLineItem data and CoverImage data.
	* Format of array is
	* array(
	* 	'Order' => array('id'=>'4864-1234-1234-1111'...),
	*	'OrderLineItem' => array(
	*		'0' => array(
	*			'id' => '1'
	*			'cart_id' => '4864-1234-1234-1111',
	*			'CoverImage' => array('dir'=>.., 'filename'=>'...')
	*		),
	*		'1' => array(
	*			'id' => '2'
	*			'cart_id' => '4864-1234-1234-1111',
	*			'CoverImage' => array('dir'=>.., 'filename'=>'...')
	*		),
	*	)
	* )
	*
	* @param string $order_uuid Order id
	* @return array Returns Order data with OrderLineItem data and CoverImage data
	**/
	public function getItemsWithImages($order_uuid) {
		
		$this->OrderLineItem->unbindModel(array(
			'belongsTo' => array(
				'OrderedVariant'
			)
		));

		// We need to do this convoluted way because we had difficulty retrieving
		// the correct CoverImage when we do a $this->find('first', array(
		//	 'contain' => array('OrderLineItem' => 'CoverImage')
		//	))
		$this->OrderLineItem->recursive = 0;
		
		$items = $this->OrderLineItem->find('all', array(
			'conditions' => array('OrderLineItem.order_id' => $order_uuid),
			'link' => array('Order', 'CoverImage')
		));

		$orderData 	= Set::extract('0.Order', $items);
		$itemsData 	= array();
		foreach($items as $key=>$item) {
			$item['OrderLineItem']['CoverImage'] 	= $item['CoverImage'];
			$itemsData[]							= $item['OrderLineItem'];					
		}

		$currentOrder = array(
			'Order' 		=> $orderData,
			'OrderLineItem' => $itemsData
		);
		
		return $currentOrder;
	}


}
?>