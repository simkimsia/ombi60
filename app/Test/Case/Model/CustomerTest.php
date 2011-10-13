<?php
/* Cart Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('Customer', 'Model');

/**
 * Customer Test Case
 *
 */
class CustomerTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 *
	 **/
	public $fixtures = array(
		'app.shop',  'app.domain',
		'app.shop_setting', 'app.language',
		'app.user', 'app.group',
		'app.merchant', 'app.customer', 'app.casual_surfer',
		'app.cart', 'app.cart_item',
		'app.order', 'app.order_line_item', 'app.address', 
		'app.product', 'app.product_image', 'app.wishlist', 
		'app.variant', 'app.variant_option', 'app.products_in_group', 'app.product_group',  
		'app.product_type', 'app.vendor',
		'app.smart_collection_condition',
		'app.webpage', 'app.page_type', 
		'app.link_list', 'app.link', 
		'app.blog', 'app.post', 'app.comment', 
		'app.payment', 'app.shops_payment_module', 'app.payment_module',
		'app.log', 'app.saved_theme',
 		'app.country',
		'app.shipment', 'app.shipping_rate', 'app.shipped_to_country',	
		'app.price_based_rate', 'app.weight_based_rate'	
	);


	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->Customer = ClassRegistry::init('Customer');
		
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
		unset($this->Customer);
		unset($this->Shop);
		unset($this->User);
		ClassRegistry::flush();

		parent::tearDown();
	}
		
	
	/**
	 * test signUpNewAccount should work
	 *
	 * @return void
	 *
	 **/
	public function testSignUpNewAccountShouldWork() {
		// GIVEN that we have 1 customer
		$count = $this->Customer->find('count');
		$this->assertEquals(1, $count);
		
		// WHEN we sign up 1 new customer
		$data = array(
			'User' => array(
				'email' 		=> 'new_customer@ombi60.com',
				'password' 		=> 'passwordhash',
				'full_name' 	=> 'some name',
				'name_to_call' 	=> 'some name to call',
			),
			'Customer' => array(
				'shop_id'		=> 2,
			)
		);
		$result = $this->Customer->signUpNewAccount($data);
		
		// THEN we get result as true
		$this->assertTrue($result);
		
		// AND the new customer has the expected data
		$customer = $this->Customer->find('first', array(
			'conditions' => array(
				'User.email' => 'new_customer@ombi60.com'
			),
			'fields' => array(
				'User.email', 
				'User.password',
				'User.full_name',
				'User.name_to_call',
				'User.group_id',
				'Customer.shop_id',
				'Customer.user_id'
			)
		));
		
		$expected = $data['User'];
		$expected['group_id'] = CUSTOMERS;
		
		$this->assertEquals($expected, $customer['User']);
		
		$expected = array(
			'id' => 2,
			'shop_id' => 2,
			'user_id' => 4,
		);
		
		$this->assertEquals($expected, $customer['Customer']);
	}
	
	
	/**
	 * test signUpNewAccountDuringCheckout should work
	 *
	 * @return void
	 *
	 **/
	public function testSignUpNewAccountDuringCheckoutShouldWork() {
		// GIVEN that we have 1 customer
		$count = $this->Customer->find('count');
		$this->assertEquals(1, $count);
		
		// WHEN we sign up 1 new customer
		$data = array(
			'User' => array(
				'email' 		=> 'new_customer@ombi60.com',
			),
			'Order' => array(
				'shop_id'		=> 2,
			),
			'BillingAddress' => array(
				'0' => array(
					'address' => 'Billing Address',					
					'city' => 'Singapore',					
					'region' => '',					
					'zip_code' => '111111',					
					'country' => '192',					
					'type'	=> BILLING,					
					'full_name' => 'some name', 
				)
			),
			'DeliveryAddress' => array(
				'0' => array(
					'address' => 'Billing Address',					
					'city' => 'Singapore',					
					'region' => '',					
					'zip_code' => '111111',					
					'country' => '192',					
					'type'	=> DELIVERY,					
					'full_name' => 'some name',				
				)	
			)
		);
		$result = $this->Customer->signupNewAccountDuringCheckout($data);
		
		// THEN we get result as true
		$this->assertTrue($result);
		
		// AND the new customer has the expected data
		$customer = $this->Customer->find('first', array(
			'conditions' => array(
				'User.email' => 'new_customer@ombi60.com'
			),
			'fields' => array(
				'User.email', 
				'User.password',
				'User.full_name',
				'User.name_to_call',
				'User.group_id',
				'Customer.shop_id',
				'Customer.user_id'
			)
		));
		
		$data['User']['full_name']		= 'some name';
		$data['User']['group_id']		= CUSTOMERS;
		$data['User']['name_to_call']	= 'some name';
		
		// AND the customer password exists
		$this->assertTrue(!empty($customer['User']['password'] ));
		
		unset($customer['User']['password']);
		
		$this->assertEquals($data['User'], $customer['User']);
		
		$expected = array(
			'id' => 2,
			'shop_id' => 2,
			'user_id' => 4,
		);
		
		$this->assertEquals($expected, $customer['Customer']);
		
		// AND the addresses are correct
		$expected['BillingAddress'] = array(
			'0' => array(
				'id' => '3'
			)
		);
		foreach($data['BillingAddress'][0] as $field => $value) {
			$expected['BillingAddress'][0][$field] = $value;
			if ($field == 'country') {
				$expected['BillingAddress'][0]['customer_id'] = 2;
			}
		}
		
		$expected['DeliveryAddress'] = array(
			'0' => array(
				'id' => '4'
			)
		);
		foreach($data['DeliveryAddress'][0] as $field => $value) {
			$expected['DeliveryAddress'][0][$field] = $value;
			if ($field == 'country') {
				$expected['DeliveryAddress'][0]['customer_id'] = 2;
			}
		}

		
		$this->assertEquals($expected['BillingAddress'], $customer['BillingAddress']);
		$this->assertEquals($expected['DeliveryAddress'], $customer['DeliveryAddress']);
	}

	/**
	 * test getExistingByShopIdAndEmail should work
	 *
	 * @return void
	 *
	 **/
	public function testGetExistingByShopIdAndEmailShouldWork() {
		// GIVEN that we have 1 customer
		$count = $this->Customer->find('count');
		$this->assertEquals(1, $count);
		
		// WHEN we look up based on ShopId and Email
		$orderFormData = array(
			'Order' => array(
				'shop_id' => 2,
			),
			'User'  => array(
				'email' => 'guest_customer@ombi60.com'
			)
		);
		
		$result = $this->Customer->getExistingByShopIdAndEmail($orderFormData);
		
		// THEN we retrieve that customer id correctly which is 1
		$this->assertEquals(1, $result);
	}
	
	/**
	 * test getExistingBillingAddress should work
	 *
	 * @return void
	 *
	 **/
	public function testGetExistingBillingAddressShouldWork() {
		// GIVEN that we have 1 customer and 2 addresses assigned to her
		$count = $this->Customer->find('count');
		$this->assertEquals(1, $count);
		
		$count = $this->Customer->BillingAddress->find('count', array(
			'customer_id' => 1,
		));
		$this->assertEquals(2, $count);
		
		// WHEN we look up the billing address
		$addressFixture = new AddressFixture();
		$billingAddress = $addressFixture->records[0];
		unset($billingAddress['id']);
		
		$this->Customer->id = 1;
		
		$result = $this->Customer->getExistingBillingAddress(array(
			'BillingAddress' => array(
				'0' => $billingAddress
			)
		));
		
		// THEN we retrieve that address id correctly
		$this->assertEquals(1, $result);
	}
	
	/**
	 * test getExistingDeliveryAddress should work
	 *
	 * @return void
	 *
	 **/
	public function testGetExistingDeliveryAddressShouldWork() {
		// GIVEN that we have 1 customer and 2 addresses assigned to her
		$count = $this->Customer->find('count');
		$this->assertEquals(1, $count);
		
		$count = $this->Customer->DeliveryAddress->find('count', array(
			'customer_id' => 1,
		));
		$this->assertEquals(2, $count);
		
		// WHEN we look up the delivery address
		$addressFixture = new AddressFixture();
		$deliveryAddress = $addressFixture->records[1];
		unset($deliveryAddress['id']);
		
		$this->Customer->id = 1;
		
		$result = $this->Customer->getExistingDeliveryAddress(array(
			'DeliveryAddress' => array(
				'0' => $deliveryAddress
			)
		));
		
		// THEN we retrieve that address id correctly
		$this->assertEquals(2, $result);
	}	
	

	/**
	 * test setNewBillingAddress should work
	 *
	 * @return void
	 *
	 **/
	public function testSetNewBillingAddressShouldWork() {
		// GIVEN that we have 1 customer and 2 addresses assigned to her
		$count = $this->Customer->find('count');
		$this->assertEquals(1, $count);
		
		$count = $this->Customer->DeliveryAddress->find('count', array(
			'customer_id' => 1,
		));
		$this->assertEquals(2, $count);
		
		// WHEN we add new billing address
		$data = array(
			'BillingAddress' => array(
				'0' => array(
					'address' => 'Billing Address',					
					'city' => 'Singapore',					
					'region' => '',					
					'zip_code' => '111111',					
					'country' => '192',					
					'type'	=> BILLING,					
					'full_name' => 'some name', 
				)
			),
		);
		
		$this->Customer->id = 1;
		
		$result = $this->Customer->setNewBillingAddress($data);
		
		// THEN result is true
		$this->assertEquals(3, $result);
		
		// AND the new address data is saved
		$expected['BillingAddress'] = array(
			'0' => array(
				'id' => '3'
			)
		);
		foreach($data['BillingAddress'][0] as $field => $value) {
			$expected['BillingAddress'][0][$field] = $value;
			if ($field == 'country') {
				$expected['BillingAddress'][0]['customer_id'] = 1;
			}
		}
		
		$customer = $this->Customer->find('first', array(
			'conditions' => array(
				'User.email' => 'guest_customer@ombi60.com'
			)
		));
		
		
		$this->assertEquals($expected['BillingAddress'][0], $customer['BillingAddress'][1]);

	}
	
	/**
	 * test setNewDeliveryAddress should work
	 *
	 * @return void
	 *
	 **/
	public function testSetNewDeliveryAddressShouldWork() {
		// GIVEN that we have 1 customer and 2 addresses assigned to her
		$count = $this->Customer->find('count');
		$this->assertEquals(1, $count);
		
		$count = $this->Customer->DeliveryAddress->find('count', array(
			'customer_id' => 1,
		));
		$this->assertEquals(2, $count);
		
		// WHEN we add new delivery address
		$data = array(
			'DeliveryAddress' => array(
				'0' => array(
					'address' => 'Delivery Address',					
					'city' => 'Singapore',					
					'region' => '',					
					'zip_code' => '111111',					
					'country' => '192',					
					'type'	=> DELIVERY,					
					'full_name' => 'some name', 
				)
			),
		);
		
		$this->Customer->id = 1;
		
		$result = $this->Customer->setNewDeliveryAddress($data);
		
		// THEN result is true
		$this->assertEquals(3, $result);
		
		// AND the new address data is saved
		$expected['DeliveryAddress'] = array(
			'0' => array(
				'id' => '3'
			)
		);
		foreach($data['DeliveryAddress'][0] as $field => $value) {
			$expected['DeliveryAddress'][0][$field] = $value;
			if ($field == 'country') {
				$expected['DeliveryAddress'][0]['customer_id'] = 1;
			}
		}
		
		$customer = $this->Customer->find('first', array(
			'conditions' => array(
				'User.email' => 'guest_customer@ombi60.com'
			)
		));		
		
		$this->assertEquals($expected['DeliveryAddress'][0], $customer['DeliveryAddress'][1]);	}	
	

}
