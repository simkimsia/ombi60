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
		'app.cart', 'app.customer', 'app.shop', 
		'app.merchant', 'app.order', 'app.address', 
		'app.product', 'app.product_image', 'app.order_line_item', 
		'app.webpage', 'app.wishlist', 'app.cart_item', 
		'app.page_type', 'app.user', 'app.group',
		'app.variant', 'app.variant_option', 'app.products_in_group',
		'app.product_group', 'app.shop_setting', 'app.domain', 
		'app.casual_surfer', 'app.link_list', 'app.link', 
		'app.blog', 'app.post', 'app.comment', 
		'app.shops_payment_module', 'app.log', 'app.saved_theme',
		'app.vendor', 'app.country'
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
	* check for OrderLineItem data to be valid
	* @param string $orderId
	* @return void
	**/
	private function orderLineItemsShouldBeValid($orderId) {
		$cartItemFixture 	= new CartItemFixture();
		$expected 			= $cartItemFixture->getAllAsOrderLineItemBelongingTo($orderId);
		
		$this->Order->OrderLineItem->recursive 	= -1;
		
		$orderLineItems = $this->Order->OrderLineItem->find('all', array(
			'conditions' => array(
				'order_id' => $orderId,
			)
		));

		$this->assertEquals($expected, $orderLineItems);		
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
			'customer_id' => 1,
			'billing_address_id' => 1,
			'delivery_address_id' => 2,
			'order_no' 	=> '10001',
			'contact_email' => 'fake_customer@gmail.com'

		);
		
		
		$expectedOptions = array_merge($defaultOptions, $expectedOptions);
		
		$expectedArray = array(
			'Order' => array(
				'id' 					=> '4e8d35a1-a9e4-4732-858f-0b711507707a',
				'shop_id' 				=> 2,
	            'customer_id' 			=> $expectedOptions['customer_id'],
	            'billing_address_id' 	=> $expectedOptions['billing_address_id'],
	            'delivery_address_id' 	=> $expectedOptions['delivery_address_id'],
				'order_no'				=> $expectedOptions['order_no'],
				'created'				=> '2011-10-06 04:59:13',
				'amount'				=> '23.0000',
				'status'				=> 1,
				'cart_id'				=> '4e895a91-b374-4a1a-947c-0b701507707a',
				'payment_status'		=> 0,
				'fulfillment_status'	=> 1,
				'shipped_weight'		=> 2000,
				'shipped_amount'		=> '23.0000',
				'currency'				=> 'SGD',
				'total_weight'			=> 2000,
				'past_checkout_point'	=> NULL,
				'contact_email'			=> $expectedOptions['contact_email'],
				'order_line_item_count'	=> 1,
				'delivered_to_country'	=> '192',
				'shipping_required'		=> 1,
			),
			
	
		);		
		
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
		$orderFormData = array(
			'Order' => array(
				'cart_id' => '4e895a91-b374-4a1a-947c-0b701507707a',
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
		$expectedCustomerId 		= 2;
		$expectedUserId 			= 4;
		$expectedBillingAddressId	= 3;
		$expectedDeliveryAddressId	= 4;
		$expectedContactEmail 		= 'fake_customer@gmail.com';
		$expectedOrderNo			= '10001';

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
		$this->orderLineItemsShouldBeValid($orderId);
		
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
		$orderFormData = array(
			'Order' => array(
				'cart_id' => '4e895a91-b374-4a1a-947c-0b701507707a',
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
		$expectedOrderNo			= '10001';

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
		$this->orderLineItemsShouldBeValid($orderId);

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
		$orderFormData = array(
			'Order' => array(
				'cart_id' => '4e895a91-b374-4a1a-947c-0b701507707a',
				'shop_id' => '2'
			),
			
		// AND the billing address exists in database
			'BillingAddress' => array(
				'0' => array(
					'address' => 'Billing Address St. Block 123 #01-911',
					'city' => 'Singapore',
					'zip_code' => '111111',
					'country' => '192',
					'region' => NULL,
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
					'region' => NULL,
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
		$expectedOrderNo			= '10001';

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
		$this->orderLineItemsShouldBeValid($orderId);

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


	
}
