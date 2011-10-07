<?php
/* Order Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('Payment', 'Model');

/**
 * Order Test Case
 *
 */
class PaymentTestCase extends CakeTestCase {
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

		$this->Payment = ClassRegistry::init('Payment');
		
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
		unset($this->Payment);
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
	private function getAllCartItemsAsOrderLineItemBelongingTo($orderId) {
		$cartItemFixture 	= new CartItemFixture();
		$records			= $cartItemFixture->records;
		
		$orderLineItemFixture 			= new OrderLineItemFixture();
		$sizeOfRecordsInOrderLineItem 	= count($orderLineItemFixture->records);
		
		$orderLineItems = array();

		// looping through the records
		foreach($records as $cartItem) {
			
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
			$orderLineItem['shipping_required'] = $cartItem['shipping_required'];
			$orderLineItem['variant_id'] 		= $cartItem['variant_id'];
			$orderLineItem['variant_title'] 	= $cartItem['variant_title'];
			
			$orderLineItems[]['OrderLineItem'] = $orderLineItem;
		}
		
		return $orderLineItems;
	}
	
	
	/**
	*
	* check for OrderLineItem data to be valid
	* @param string $orderId
	* @return void
	**/
	private function orderLineItemsShouldBeValid($orderId) {

		$expected = $this->getAllCartItemsAsOrderLineItemBelongingTo($orderId);
		
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
			'order_no' 	=> '10002',
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
				'shipped_weight'		=> 15000,
				'shipped_amount'		=> '23.0000',
				'currency'				=> 'SGD',
				'total_weight'			=> 15000,
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

	
	
	
	public function testGetOptionsForCheckoutShouldGrabRelevantOptions() {
		
	}
	


	
}
