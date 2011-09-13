<?php
class Order extends AppModel {

	var $name = 'Order';
	
	var $actsAs = array('Filter.Filter');

	var $belongsTo = array(
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

	
	
	var $hasMany = array(
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
	function convertCart($cartData, $options = array()) {
		
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
	
	function removeCart($cart_id) {
		$cart = ClassRegistry::init('Cart'); 
		return $cart->delete($cart_id);
	}
	
	
	function beforeSave() {
		
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
	
	function getDetailed($id, $lineItems = true) {
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
	
	function getShippingRequired($id = false) {
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

	
	function afterSave($created) {
		if ($created) {
			$this->Customer->User->Cart->id = $this->data['Order']['cart_id'];
			$this->Customer->User->Cart->saveField('order_id', $this->id);
		}
	}
	
	function saveForCheckoutStep1($data) {
		
		$result = $this->saveAll($data);
		if ($result) {
			
			$hash = $this->field('hash', array('id'=>$this->id));
			return array('result'=>$result, 'hash'=>$hash);
		}
		
		return $result;
		
	}
	
	function savePaymentAndShipment($data) {
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
	
	function updatePrices($id = false, $cartData = array()) {
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
	

}
?>