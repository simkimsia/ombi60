<?php
/* Order Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('Order', 'Model');

/**
 * Order Test Case
 *
 */
class OrderTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.aro', 'app.aco', 'app.aros_aco',
		'app.shop',  'app.domain',
		'app.shop_setting', 'app.language',
		'app.user', 'app.group',
		'app.merchant', 'app.customer', 'app.casual_surfer',
		'app.cart', 'app.cart_item',
		'app.order', 'app.order_line_item', 'app.fulfillment', 'app.address', 
		'app.product', 'app.product_image', 'app.wishlist', 
		'app.variant', 'app.variant_option', 'app.products_in_group', 'app.product_group',  
		'app.product_type', 'app.vendor',
		'app.smart_collection_condition',
		'app.webpage', 'app.page_type', 
		'app.link_list', 'app.link', 
		'app.blog', 'app.post', 'app.comment', 
		'app.paypal_payment_module',
		'app.payment', 'app.shops_payment_module', 'app.payment_module',
		'app.log', 'app.saved_theme', 'app.theme',
		'app.country',
		'app.shipment', 'app.shipping_rate', 'app.shipped_to_country',	
		'app.price_based_rate', 'app.weight_based_rate',
		'app.invoice', 'app.recurring_payment_profile',
	
	);


/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Order = ClassRegistry::init('Order');
		
		// setting up Shop and User singleton
		$this->Shop 	= ClassRegistry::init('Shop');
		$this->User 	= ClassRegistry::init('User');
		
		$cachedShopId = Shop::get('Shop.id');
		
		if ($cachedShopId != 2) {
			$testShop = $this->Shop->getById(2);
			Shop::store($testShop);
		}
		
		$cachedUserId = User::get('User.id');
		
		if($cachedUserId != 2) {
			User::store($this->User->read(null, 2));
		}
		// this is to allow User singleton to work properly
		// look at AppController beforeFilter
		Configure::write('run_test', true);
		
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Order);
		unset($this->Shop);
		unset($this->User);
		ClassRegistry::flush();

		parent::tearDown();
	}
	
	/**
	*
	* check for id to be valid
	* @param string $orderId
	* @return void
	**/
	private function idShouldBeValid($orderId) {
		// Should be a string
		$this->assertTrue(is_string($orderId));
		// AND the Order ID is a 36 char string
		$this->assertEquals(strlen($orderId), 36);
	}
	
	/**
	*
	* where we use the data in $records and generate an array where the index is OrderLineItem
	* and it contains all the corresponding OrderLineItem data
	**/
	private function getAllCartItemsAsOrderLineItemBelongingTo($orderId, $cartId) {
		$cartItemFixture 	= new CartItemFixture();
		$records			= $cartItemFixture->records;
		
		$orderLineItemFixture 			= new OrderLineItemFixture();
		$sizeOfRecordsInOrderLineItem 	= count($orderLineItemFixture->records);
		
		$orderLineItems = array();

		// looping through the records
		foreach($records as $cartItem) {
			
			if ($cartItem['cart_id'] == $cartId)  {
				$sizeOfRecordsInOrderLineItem++;			

				// add in fields and values unique to OrderLineItem
				$orderLineItem['id']				= $sizeOfRecordsInOrderLineItem;
				$orderLineItem['order_id'] 			= $orderId;
				$orderLineItem['product_id']		= $cartItem['product_id'];
				$orderLineItem['product_price']		= $cartItem['product_price'];
				$orderLineItem['product_quantity']	= $cartItem['product_quantity'];
				$orderLineItem['status'] 			= 1;
				$orderLineItem['product_title'] 	= $cartItem['product_title'];
				$orderLineItem['product_weight'] 	= $cartItem['product_weight'];
				$orderLineItem['currency'] 			= $cartItem['currency'];
				$orderLineItem['shipping_required'] = (boolean)$cartItem['shipping_required'];
				$orderLineItem['variant_id'] 		= $cartItem['variant_id'];
				$orderLineItem['variant_title'] 	= $cartItem['variant_title'];
				$orderLineItem['fulfillment_id']	= null;

				$orderLineItems[]['OrderLineItem'] = $orderLineItem;
				
			}
		}
		
		return $orderLineItems;
	}
	
	
	/**
	*
	* check for OrderLineItem data to be valid
	*
	* @param string $orderId
	* @return void
	**/
	private function orderLineItemsShouldBeValid($orderId, $cartId, $coverImage = false) {

		$expected = $this->getAllCartItemsAsOrderLineItemBelongingTo($orderId, $cartId);
		
		$this->Order->OrderLineItem->recursive 	= -1;
		
		if($coverImage) {
			$coverImage = array('CoverImage');
		}
		

		$orderLineItems = $this->Order->OrderLineItem->find('all', array(
			'conditions' => array(
				'order_id' => $orderId,
			),
			'contain' => $coverImage,
		));
		
		$this->assertEquals($expected, $orderLineItems);		
	}
	
	private function orderLineItemsDataShouldBeValid($actualData, $orderId, $cartId, $coverImage = false) {
		$this->Order->OrderLineItem->recursive = 1;
		
		if($coverImage) {
			$coverImage = array('CoverImage');
		}
		

		$orderLineItems = $this->Order->OrderLineItem->find('all', array(
			'conditions' => array(
				'OrderLineItem.order_id' => $orderId,
			),
			'link' => $coverImage,
		));
		
		$expected = array('OrderLineItem' => array());
		foreach($orderLineItems as $key=>$item) {
			$expectedItem = $item['OrderLineItem'];
			$expectedImage= $item['CoverImage'];
			$expectedItem['CoverImage'] = $expectedImage;
			$expected['OrderLineItem'][] = $expectedItem;
		}
		
		$this->assertEquals($expected, $actualData);
	}
	
	/**
	*
	* check for Customer data and User id to be valid
	*
	* @param integer $expectedCustomerId
	* @param integer $expectedUserId
	* @return void
	*
	**/
	private function userCustomerShouldBeValid($expectedCustomerId, $expectedUserId) {

		$this->Order->Customer->recursive = -1;
		
		$customerId = $this->Order->field('customer_id');
		$customer 	= $this->Order->Customer->find('all', array(
			'conditions'=> array(
				'Customer.id' => $customerId,
			)
		));
		
		$expected 	= array();
		$expected[] = array(
			'Customer' => array(
				'id' 			=> $expectedCustomerId,
				'identity_code' => '',
				'shop_id' 		=> 2,
				'user_id' 		=> $expectedUserId,
			)
		);
		
		$this->assertEquals($expected, $customer);

	}
	
	/**
	*
	* check for Address model data to be valid
	*
	* @param array $expectedAddressData
	* @return void
	**/
	private function addressShouldBeValid($expectedAddressData) {
		if ($expectedAddressData['type'] == BILLING) {
			$modelName = 'BillingAddress';
			$primaryKey = 'billing_address_id';
		} elseif ($expectedAddressData['type'] == DELIVERY) {
				$modelName = 'DeliveryAddress';
				$primaryKey = 'delivery_address_id';
		}
		
		$expected 	= array();
		$expected[] = array(
			$modelName => $expectedAddressData
		);
		
		$this->Order->{$modelName}->recursive = -1;
		
		$addressId 	= $this->Order->field($primaryKey);
		$actual 	= $this->Order->{$modelName}->find('all', array(
			'conditions' => array(
				'id' => $addressId,
			)
		));
		
		$this->assertEquals($expected, $actual); 
	}
	
	
	/**
	*
	* check the Order model data if it is valid
	*
	* @param array $resultArray
	* @param array $expectedOptions
	* @return void
	**/
	private function orderShouldBeValid($resultArray, $expectedOptions = array()) {
		
		$defaultOptions = array(
			'customer_id' => '1',
			'billing_address_id' => '1',
			'delivery_address_id' => '2',
			'order_no' 	=> '10003',
			'contact_email' => 'fake_customer@gmail.com',
			'id'	=> '4e8d35a1-a9e4-4732-858f-0b711507707a',
			'status' => '0'
		);
		
		
		$expectedOptions = array_merge($defaultOptions, $expectedOptions);
		if ($expectedOptions['id'] == '4e91458a-b0f8-452c-ab84-1d351507707a') {

			$expectedArray = array(
				'Order' => array(
					'id' 					=> $expectedOptions['id'],
					'shop_id' 				=> '2',
		            'customer_id' 			=> $expectedOptions['customer_id'],
		            'billing_address_id' 	=> $expectedOptions['billing_address_id'],
		            'delivery_address_id' 	=> $expectedOptions['delivery_address_id'],
					'order_no'				=> $expectedOptions['order_no'],
					'created'				=> '2011-10-06 04:59:13',
					'amount'				=> '34.0000',
					'status'				=> $expectedOptions['status'],
					'cart_id'				=> '4e9144d7-55e4-44a6-a2f1-1f721507707a',
					'payment_status'		=> '0',
					'fulfillment_status'	=> '1',
					'net_amount'			=> '34.0000',
					'shipped_weight'		=> 22000,
					'shipping_fee'			=> '0.0000',					
					'shipped_amount'		=> '34.0000',
					'currency'				=> 'SGD',
					'total_weight'			=> 22000,
					'past_checkout_point'	=> NULL,
					'contact_email'			=> $expectedOptions['contact_email'],
					'order_line_item_count'	=> 2,
					'fulfilled_item_count'	=> 1,
					'delivered_to_country'	=> '192',
					'shipping_required'		=> 1,
					'note'					=> '',
					'cancel_reason'			=> ''
				),


			);
			
		} else {

			$expectedArray = array(
				'Order' => array(
					'id' 					=> $expectedOptions['id'],
					'shop_id' 				=> '2',
		            'customer_id' 			=> $expectedOptions['customer_id'],
		            'billing_address_id' 	=> $expectedOptions['billing_address_id'],
		            'delivery_address_id' 	=> $expectedOptions['delivery_address_id'],
					'order_no'				=> $expectedOptions['order_no'],
					'created'				=> '2011-10-06 04:59:13',
					'amount'				=> '23.0000',
					'status'				=> $expectedOptions['status'],
					'cart_id'				=> '4e895a91-b374-4a1a-947c-0b701507707a',
					'payment_status'		=> '0',
					'fulfillment_status'	=> 1,
					'net_amount'			=> '23.0000',
					'shipped_weight'		=> 15000,
					'shipping_fee'			=> '0.0000',
					'shipped_amount'		=> '23.0000',
					'currency'				=> 'SGD',
					'total_weight'			=> 15000,
					'past_checkout_point'	=> NULL,
					'contact_email'			=> $expectedOptions['contact_email'],
					'order_line_item_count'	=> 1,
					'fulfilled_item_count'	=> 0,
					'delivered_to_country'	=> '192',
					'shipping_required'		=> 1,
					'note'					=> '',
					'cancel_reason'			=> ''
				),


			);
			
		}
		
		$this->expectedOrderShouldMatchActualOrder($expectedArray, $resultArray);
				
	}
	
	
	private function expectedOrderShouldMatchActualOrder($expectedArray, $resultArray) {
		$fieldsExpectedToBeDifferent = array('created', 'id');

		$resultCart 	= $resultArray['Order'];
		$expectedCart	= $expectedArray['Order'];

		// check that these 2 fields exist
		$this->assertArrayHasKey('id', $resultCart);
		$this->assertArrayHasKey('created', $resultCart);

		// check that the created and modified are not empty
		$this->assertNotEmpty($resultCart['created']);
		$this->assertNotEmpty($resultCart['id']);

		$this->idShouldBeValid($resultCart['id']);
		
		// check that the other fields with EXACT field and values are expected
		foreach($fieldsExpectedToBeDifferent as $field) {

			unset($resultCart[$field]);
			unset($expectedCart[$field]);
						
		}

		$this->assertEquals($expectedCart, $resultCart);
	}
/**
 * 
 * Test createForm function for the scenario where we should have
 * new Customer, new Addresses 
 *
 * @return void
 */
	public function testCreateFormShouldGiveNewCustomerNewAddresses() {
			
		// GIVEN valid order form data
		$cart_uuid = '4e895a91-b374-4a1a-947c-0b701507707a';
		
		$orderFormData = array(
			'Order' => array(
				'cart_id' => $cart_uuid,
				'shop_id' => '2'
			),
		// AND the billing address is brand new
			'BillingAddress' => array(
				'0' => array(
					'full_name' => 'Fake Full Name',
					'address'	=> '1234 St. Regis View #01-911',
					'city'		=> 'Singapore',
					'region'	=> '',
					'zip_code'	=> '123456',
					'country'	=> '192',
					'type'		=> BILLING,
				)
			),
		// AND we want the delivery address to be the same as billing address
			'DeliveryAddress' => array(
				'same' => true,
			),
		// AND this User is brand new as well
			'User' => array(
				'email' =>  'fake_customer@gmail.com',
			)
			
		);


		// WHEN  createForm is executed on the valid order form data
		$orderId = $this->Order->createFrom($orderFormData);
		
		// Then we expect the following
		$expectedCustomerId 		= '2';
		$expectedUserId 			= '4';
		$expectedBillingAddressId	= '3';
		$expectedDeliveryAddressId	= '4';
		$expectedContactEmail 		= 'fake_customer@gmail.com';
		$expectedOrderNo			= '10003';

		// AND we get valid Order data
		$this->Order->recursive = -1;
		$order = $this->Order->read(null, $orderId);
		
		$expected = array(
			'customer_id' => $expectedCustomerId,
			'billing_address_id' => $expectedBillingAddressId,
			'delivery_address_id' => $expectedDeliveryAddressId,
			'order_no' 	=> $expectedOrderNo,
			'contact_email' => $expectedContactEmail,
		);
		
		$this->orderShouldBeValid($order, $expected);
		
		// AND the Order has the correct OrderLineItem
		$this->orderLineItemsShouldBeValid($orderId, $cart_uuid);
		
		// AND a brand new Customer, User is generated
		$this->userCustomerShouldBeValid($expectedCustomerId, $expectedUserId);
		
		// AND brand new addresses for Delivery and BILLING are generated to the right Customer
		// for the right Order
		$billingAddressExpected = array(
			'id'			=> $expectedBillingAddressId,
			'address'		=> '1234 St. Regis View #01-911',
			'city'			=> 'Singapore',
			'region'		=> '',
			'zip_code'		=> '123456',
			'country'		=> '192',
			'customer_id'	=> $expectedCustomerId,
			'type'			=> BILLING,
			'full_name'		=> 'Fake Full Name',	
		);
		
		$this->addressShouldBeValid($billingAddressExpected);

		$deliveryAddressExpected = array(
			'id'			=> $expectedDeliveryAddressId,
			'address'		=> '1234 St. Regis View #01-911',
			'city'			=> 'Singapore',
			'region'		=> '',
			'zip_code'		=> '123456',
			'country'		=> '192',
			'customer_id'	=> $expectedCustomerId,
			'type'			=> DELIVERY,
			'full_name'		=> 'Fake Full Name',	
		);
		
		$this->addressShouldBeValid($deliveryAddressExpected);
	
	}
	

	/**
	 * 
	 * Test createForm function for the scenario where we should have
	 * created the form for existing Customer, new Addresses 
	 *
	 * @return void
	 **/
	public function testCreateFormShouldAttachToExistingCustomerNewAddresses() {

		// GIVEN valid order form data
		$cart_uuid = '4e895a91-b374-4a1a-947c-0b701507707a';
		$orderFormData = array(
			'Order' => array(
				'cart_id' => $cart_uuid,
				'shop_id' => '2'
			),
			
		// AND the billing address is brand new
			'BillingAddress' => array(
				'0' => array(
					'full_name' => 'Fake Full Name',
					'address'	=> '1234 St. Regis View #01-911',
					'city'		=> 'Singapore',
					'region'	=> '',
					'zip_code'	=> '123456',
					'country'	=> '192',
					'type'		=> BILLING,
				)
			),
			
		// AND we want the delivery address to be the same as billing address
			'DeliveryAddress' => array(
				'same' => true,
			),
			
		// AND this User exists as a Customer via supplying the email
			'User' => array(
				'email' =>  'guest_customer@ombi60.com',
			)

		);

		// WHEN  createForm is executed on the valid order form data
		$orderId = $this->Order->createFrom($orderFormData);

		// Then we expect the following
		$expectedCustomerId 		= 1;
		$expectedUserId 			= 3;
		$expectedBillingAddressId	= 3;
		$expectedDeliveryAddressId	= 4;
		$expectedContactEmail 		= 'guest_customer@ombi60.com';
		$expectedOrderNo			= '10003';

		// AND we get valid Order data
		$this->Order->recursive = -1;
		$order = $this->Order->read(null, $orderId);

		$expected = array(
			'customer_id' => $expectedCustomerId,
			'billing_address_id' => $expectedBillingAddressId,
			'delivery_address_id' => $expectedDeliveryAddressId,
			'order_no' 	=> $expectedOrderNo,
			'contact_email' => $expectedContactEmail,
		);

		$this->orderShouldBeValid($order, $expected);

		// AND the Order has the correct OrderLineItem
		$this->orderLineItemsShouldBeValid($orderId, $cart_uuid);

		// AND a brand new Customer, User is generated
		$this->userCustomerShouldBeValid($expectedCustomerId, $expectedUserId);

		// AND brand new addresses for Delivery and BILLING are generated to the right Customer
		// for the right Order
		$billingAddressExpected = array(
			'id'			=> $expectedBillingAddressId,
			'address'		=> '1234 St. Regis View #01-911',
			'city'			=> 'Singapore',
			'region'		=> '',
			'zip_code'		=> '123456',
			'country'		=> '192',
			'customer_id'	=> $expectedCustomerId,
			'type'			=> BILLING,
			'full_name'		=> 'Fake Full Name',	
		);

		$this->addressShouldBeValid($billingAddressExpected);

		$deliveryAddressExpected = array(
			'id'			=> $expectedDeliveryAddressId,
			'address'		=> '1234 St. Regis View #01-911',
			'city'			=> 'Singapore',
			'region'		=> '',
			'zip_code'		=> '123456',
			'country'		=> '192',
			'customer_id'	=> $expectedCustomerId,
			'type'			=> DELIVERY,
			'full_name'		=> 'Fake Full Name',	
		);

		$this->addressShouldBeValid($deliveryAddressExpected);

	}	

	/**
	 * 
	 * Test createForm function for the scenario where we should have
	 * created the form for existing Customer and Addresses 
	 *
	 * @return void
	 **/
	public function testCreateFormShouldAttachToExistingCustomerAddresses() {

		// GIVEN valid order form data
		$cart_uuid = '4e895a91-b374-4a1a-947c-0b701507707a';
		$orderFormData = array(
			'Order' => array(
				'cart_id' => $cart_uuid,
				'shop_id' => '2'
			),
			
		// AND the billing address exists in database
			'BillingAddress' => array(
				'0' => array(
					'address' => 'Billing Address St. Block 123 #01-911',
					'city' => 'Singapore',
					'zip_code' => '111111',
					'country' => '192',
					'region' => '',
					'type' => BILLING,
					'full_name' => 'G. Cherry'				
				)
			),
			
		// AND the delivery address exists in database
			'DeliveryAddress' => array(
				'same' => 0,
				'0' => array(
					'address' => 'Delivery Address Block 123 #01-911',
					'city' => 'Singapore',
					'zip_code' => '111111',
					'country' => '192',
					'region' => '',
					'type' => DELIVERY,
					'full_name' => 'G. Cherry'
				)
			),
			
		// AND this User exists as a Customer via supplying the email
			'User' => array(
				'email' =>  'guest_customer@ombi60.com',
			)

		);

		// WHEN  createForm is executed on the valid order form data
		$orderId = $this->Order->createFrom($orderFormData);

		// Then we expect the following
		$expectedCustomerId 		= 1;
		$expectedUserId 			= 3;
		$expectedBillingAddressId	= 1;
		$expectedDeliveryAddressId	= 2;
		$expectedContactEmail 		= 'guest_customer@ombi60.com';
		$expectedOrderNo			= '10003';

		// AND we get valid Order data
		$this->Order->recursive = -1;
		$order = $this->Order->read(null, $orderId);

		$expected = array(
			'customer_id' => $expectedCustomerId,
			'billing_address_id' => $expectedBillingAddressId,
			'delivery_address_id' => $expectedDeliveryAddressId,
			'order_no' 	=> $expectedOrderNo,
			'contact_email' => $expectedContactEmail,
		);

		$this->orderShouldBeValid($order, $expected);

		// AND the Order has the correct OrderLineItem
		$this->orderLineItemsShouldBeValid($orderId, $cart_uuid);

		// AND a brand new Customer, User is generated
		$this->userCustomerShouldBeValid($expectedCustomerId, $expectedUserId);

		// AND existing addresses for Delivery and BILLING are generated to the right Customer
		// for the right Order
		$addressFixture = new AddressFixture();
		
		$billingAddressExpected = $addressFixture->records[0];
		$this->addressShouldBeValid($billingAddressExpected);
		
		$deliveryAddressExpected = $addressFixture->records[1];
		$this->addressShouldBeValid($deliveryAddressExpected);

	}	
	
	
	public function testGetItemsWithImagesShouldContainRightItemsAndImages() {
		// Given that we have the order_uuid
		$orderId = '4e91458a-b0f8-452c-ab84-1d351507707a';
		$cart_uuid  = '4e9144d7-55e4-44a6-a2f1-1f721507707a';
		
		// WHEN we run getItemsWithImages
		$resultArray = $this->Order->getItemsWithImages($orderId);

		// Then we expect the following
		$expectedCustomerId 		= '1';
		$expectedUserId 			= '3';
		$expectedBillingAddressId	= '1';
		$expectedDeliveryAddressId	= '2';
		$expectedContactEmail 		= 'guest_customer@ombi60.com';
		$expectedOrderNo			= '10002';
		$expectedStatus				= '1';


		$expected = array(
			'customer_id' => $expectedCustomerId,
			'billing_address_id' => $expectedBillingAddressId,
			'delivery_address_id' => $expectedDeliveryAddressId,
			'order_no' 	=> $expectedOrderNo,
			'contact_email' => $expectedContactEmail,
			'id'		=> $orderId,
			'status'	=> $expectedStatus
		);

		// AND the Order is valid
		$this->orderShouldBeValid($resultArray, $expected);

		// AND the Order has the correct OrderLineItem
		$checkCoverImage = true;
		$orderLineItems = array('OrderLineItem' => $resultArray['OrderLineItem']);
		$this->orderLineItemsDataShouldBeValid($orderLineItems, $orderId, $cart_uuid, $checkCoverImage);

		// AND a brand new Customer, User is generated
		$this->userCustomerShouldBeValid($expectedCustomerId, $expectedUserId);
		
		
	}
	
	public function testExtractShipmentDataFromShippingRateShouldWork() {
		// Given that we use Shipping Rate 7 as the shipping rate data for input
		$shippingRateFixture 	= new ShippingRateFixture();
		$shippingRate 			= $shippingRateFixture->records[6];
		
		// WHEN we run the function
		$shipmentData = $this->Order->extractShipmentDataFromShippingRate(array(
			'ShippingRate' => $shippingRate,
		));
		
		// THEN we get the following
		
		$expectedShipmentData = array(
			'Shipment' => array(
				'shipping_rate_id' => $shippingRate['id'],
				'name'				=> $shippingRate['name'],
				'description'		=> $shippingRate['description'],
				'price'				=> $shippingRate['price'],
				
			)
		);
		
		$this->assertEquals($expectedShipmentData,$shipmentData);
		
	}
	
	/**
	*	
	* Associated Cart closed. And we have a Payment and Shipment data
	*
	**/
	public function testCompletePurchaseShouldCloseTheCartAndHaveShipmentPaymentData() {
		// Given that we have the following data to complete the purchase
		$order_uuid = '4e91458a-b0f8-452c-ab84-1d351507707a';
		
		$orderFormData = array(
			'Order' => array(
				'id' => $order_uuid,
				'shop_id' => 2,
			),
			'Payment' => array(
				'0' => array(
					'shops_payment_module_id' => '1',
				)
			),
			'Shipment' => array(
				'0' =>array(
					'shipping_rate_id' 	=> 3,
					'name'				=> 'Standard Shipping',
					'description'		=> 'From 10kg to 20kg',
					'price'				=> '10.000',
				)
			
			)
		);
		$this->Order->id = $order_uuid;
		// WHEN we complete the purchase
		$result = $this->Order->completePurchase($orderFormData);
		
		// THEN the result is true
		$this->assertTrue($result);
		// AND the associated Cart is closed
		$this->Order->Cart->id = '4e9144d7-55e4-44a6-a2f1-1f721507707a';
		$closed = $this->Order->Cart->field('past_checkout_point');
		$this->assertTrue($closed);
		
		// AND Payment data valid
		$noOfPayments = $this->Order->Payment->find('count', array(
			'conditions' => array(
				'Payment.order_id' 					=> $order_uuid,
				'Payment.id'						=> 1,
				'Payment.shops_payment_module_id' 	=> 1,
			)
		));
		$this->assertEquals(1, $noOfPayments);
				
		// AND Shipment data valid
		$noOfShipments = $this->Order->Shipment->find('count', array(
			'conditions' => array(
				'Shipment.id'			=> 1,
				'Shipment.order_id' 	=> $order_uuid,
				'Shipment.name' 		=> 'Standard Shipping',
				'Shipment.description'	=> 'From 10kg to 20kg',
				'Shipment.price' 		=> 10.000,
			)
		));
		$this->assertEquals(1, $noOfShipments);
	}
	
	/**
	*
	* test getDetailed works for orders admin view
	*
	**/
	public function testGetDetailed() {
		// GIVEN the ORDER 1 associated with Customer 1
		
		// WHEN we run getDetailed
		$order_uuid	= '4e8d8ef9-71a4-4a69-8dbf-04b01507707a';
		$order		= $this->Order->getDetailed($order_uuid);
		
		// THEN we get all the following information
		$orderFixture = new OrderFixture();
		$customerFixture = new CustomerFixture();
		$addressFixture = new AddressFixture();
		$userFixture = new UserFixture();
		$itemFixture = new OrderLineItemFixture();
		
		$order1 = $orderFixture->records[0];
		$order1['shipping_required'] = true;
		$order1['net_amount'] = $order1['amount'];
		
		$expected = array(
			'Order' 	=> $order1,
			'Customer' 	=> 	$customerFixture->records[0],
			'BillingAddress' => $addressFixture->records[0],
			'DeliveryAddress' => $addressFixture->records[1],
			'User'				=> $userFixture->records[2],
			'OrderLineItem' => array($itemFixture->records[0]),
			'Payment' => array(),
			'Shipment' => array(),
		);
		
		App::uses('ArrayLib', 'UtilityLib.Lib');
		$this->assertEquals(ArrayLib::deepKSort($expected), ArrayLib::deepKSort($order));
	}

	/**
	*
	* test getDetailed works for orders that is only above the ORDER_CREATED level for admin
	*
	**/
	public function testGetDetailedShowsAboveCreated() {
		// GIVEN the ORDER  associated with Customer 1
		
		// WHEN we run getDetailed
		$deleted	= '4e8d8ef9-71a4-4a69-8dbf-04b01507707f'; // deleted order
		$order		= $this->Order->getDetailed($deleted);
		
		// THEN we get all the following information
		$this->assertFalse($order);
	}
	
	/**
	*
	* confirm match  with cart must work when they match
	*
	**/
	public function testConfirmMatchWithCartWorksForMatch() {
		// GIVEN we have identical cart and order data
		$order_uuid = '4e8d8ef9-71a4-4a69-8dbf-04b01507707a';
		$cart_uuid 	= '4e895a91-b374-4a1a-947c-0b701507707a';
		// WHEN we run confirmMatchWithCart
		$result = $this->Order->confirmMatchWithCart($order_uuid, $cart_uuid);
		// THEN we get a boolean true
		$this->assertTrue($result);
	}

	/**
	*
	* confirm  match with cart must work when they DONT match
	*
	**/
	public function testConfirmMatchWithCartWorksForNoMatch() {
		// GIVEN we have not Identical cart and order data
		// AND the weight does not match
		$order_uuid = '4e8d8ef9-71a4-4a69-8dbf-04b01507707a';
		$cart_uuid 	= '4e895a91-b374-4a1a-947c-0b701507707a';
		
		$this->Order->Cart->id = $cart_uuid;
		$result = $this->Order->Cart->save(array(
			'past_checkout_point' => true,
		));
		$this->assertTrue(!empty($result));
		
		// WHEN we run confirmMatchWithCart
		$result = $this->Order->confirmMatchWithCart($order_uuid, $cart_uuid);
		// THEN we get a boolean true
		$this->assertFalse($result);
	}
	
	
	/**
	*
	* test if the completedCheckout check works
	*
	**/
	public function testCompletedCheckout() {
		// GIVEN we are using the following order
		$order_uuid = '4e8d8ef9-71a4-4a69-8dbf-04b01507707a';
		
		// WHEN we run the funciton
		$result = $this->Order->completedCheckout($order_uuid);
		
		// THEN we expect true
		$this->assertTrue($result);
		
	}
	
	
	/**
	*
	* test if the getDeliveryAddressByOrderId works
	*
	**/
	public function testGetDeliveryAddressByOrderId() {
		// GIVEN we are using the following order
		$order_uuid = '4e8d8ef9-71a4-4a69-8dbf-04b01507707a';
		
		// WHEN we run the funciton
		$result = $this->Order->getDeliveryAddressByOrderId($order_uuid);
		
		// THEN we get back the 2nd record of the Address Fixture
		$addressFixture = new AddressFixture();
		$countryFixture = new CountryFixture();
		$expected = array(
			'DeliveryAddress' => $addressFixture->records[1],
			'Country' => $countryFixture->records[191]
		);
		$this->assertEqual($expected, $result);
		
	}
	
	/**
	*
	* test if isValidForCancel works for PAYMENT_PAID, PAYMENT_AUTHORIZED, PAYMENT_PENDING, PAYMENT_ABANDONED,
	* PAYMENT_REFUNDED, PAYMENT_VOIDED
	**/
	public function testIsValidForCancel() {
		// GIVEN we are using the following orders
		$abandoned = '4e8d8ef9-71a4-4a69-8dbf-04b01507707a'; // ABANDONED
		$paid = '4e8d8ef9-71a4-4a69-8dbf-04b01507707b'; 
		$authorized = '4e8d8ef9-71a4-4a69-8dbf-04b01507707c'; 
		
		// WHEN we run the function 
		$abandonedResult = $this->Order->isValidForCancel($abandoned);
		$paidResult = $this->Order->isValidForCancel($paid);
		$authorizedResult = $this->Order->isValidForCancel($authorized);		
		
		// THEN we expect teh following
		$this->assertFalse($abandonedResult);
		$this->assertTrue($paidResult);
		$this->assertTrue($authorizedResult);
		
	}
	
	/**
	*
	* test if isValidForDelete works for ORDER_CANCELLED, ORDER_CLOSED, ORDER_OPENED
	**/
	public function testIsValidForDelete() {
		// GIVEN we are using the following orders
		$opened = '4e8d8ef9-71a4-4a69-8dbf-04b01507707a'; // OPENED
		$cancelled = '4e8d8ef9-71a4-4a69-8dbf-04b01507707d'; 
		$closed = '4e8d8ef9-71a4-4a69-8dbf-04b01507707e'; 
		
		// WHEN we run the function 
		$openedResult = $this->Order->isValidForDelete($opened);
		$cancelledResult = $this->Order->isValidForDelete($cancelled);
		$closedResult = $this->Order->isValidForDelete($closed);		
		
		// THEN we expect teh following
		$this->assertFalse($openedResult);
		$this->assertTrue($cancelledResult);
		$this->assertTrue($closedResult);
		
	}

	/**
	*
	* test if isValidForOpen works for ORDER_CANCELLED, ORDER_CLOSED, ORDER_OPENED
	**/
	public function testIsValidForOpen() {
		// GIVEN we are using the following orders
		$opened = '4e8d8ef9-71a4-4a69-8dbf-04b01507707a'; // OPENED
		$cancelled = '4e8d8ef9-71a4-4a69-8dbf-04b01507707d'; 
		$closed = '4e8d8ef9-71a4-4a69-8dbf-04b01507707e'; 
		
		// WHEN we run the function 
		$openedResult = $this->Order->isValidForOpen($opened);
		$cancelledResult = $this->Order->isValidForOpen($cancelled);
		$closedResult = $this->Order->isValidForOpen($closed);		
		
		// THEN we expect teh following
		$this->assertTrue($openedResult);
		$this->assertFalse($cancelledResult);
		$this->assertTrue($closedResult);
		
	}	
	
	/**
	*
	* test if isValidForClose works for ORDER_CANCELLED, ORDER_CLOSED, ORDER_OPENED
	**/
	public function testIsValidForClose() {
		// GIVEN we are using the following orders
		$opened = '4e8d8ef9-71a4-4a69-8dbf-04b01507707a'; // OPENED
		$cancelled = '4e8d8ef9-71a4-4a69-8dbf-04b01507707d'; 
		$closed = '4e8d8ef9-71a4-4a69-8dbf-04b01507707e'; 
		
		// WHEN we run the function 
		$openedResult = $this->Order->isValidForClose($opened);
		$cancelledResult = $this->Order->isValidForClose($cancelled);
		$closedResult = $this->Order->isValidForClose($closed);		
		
		// THEN we expect teh following
		$this->assertTrue($openedResult);
		$this->assertFalse($cancelledResult);
		$this->assertTrue($closedResult);
		
	}
	
	/**
	*
	* test for update fulfillment status
	**/
	public function testUpdateFulfillmentStatus() {
		// GIVEN we have the fulfilled_item_count for order to be 0, less than and equal
		// to order_line_item_count
		$lessThan	= '4e91458a-b0f8-452c-ab84-1d351507707a'; 
		$zeroed 	= '4e8d8ef9-71a4-4a69-8dbf-04b01507707b'; 
		$equal		= '4e8d8ef9-71a4-4a69-8dbf-04b01507707c'; 
		
		// WHEN we run updateFulfillmentStatus for all 3
		$this->Order->updateFulfillmentStatus($lessThan);
		$this->Order->updateFulfillmentStatus($zeroed);
		$this->Order->updateFulfillmentStatus($equal);		
		
		// THEN we expect the following
		$this->Order->id = $lessThan;
		$this->assertEquals(FULFILLMENT_PARTIAL, $this->Order->field('fulfillment_status'));
		$this->Order->id = $zeroed;
		$this->assertEquals(FULFILLMENT_NOT_FULFILLED, $this->Order->field('fulfillment_status'));
		$this->Order->id = $equal;
		$this->assertEquals(FULFILLMENT_FULFILLED, $this->Order->field('fulfillment_status'));

	}

}
