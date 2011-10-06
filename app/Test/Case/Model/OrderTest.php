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
		'app.vendor', 
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
	
	private function setUpForEmptyOrder() {
		$this->Order->query('TRUNCATE table `orders`');
		$this->Order->query('TRUNCATE table `order_items`');
		$this->User->id = 2;
		
		$noOfOrders = $this->Order->find('count', array(
			'conditions' => array('Order.user_id' => 2)
		));
		$this->assertEquals($noOfOrders, 0);
	}

/**
 * testMakeThisPrimary method
 *
 * @return void
 */
	public function testShouldGenerateValidOrderUsingFunctionCreateForm() {
				
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

		// THEN we get a valid Order ID
		$this->assertTrue(is_string($orderId));
		// AND the Order ID is a 36 char string
		$this->assertEquals(strlen($orderId), 36);
		// AND the Order has the correct OrderLineItem
		$cartItemFixture 	= new CartItemFixture();
		$expected 			= $cartItemFixture->getAllAsOrderLineItemBelongingTo($orderId);
		$this->Order->OrderLineItem->recursive = -1;
		$orderLineItems = $this->Order->OrderLineItem->find('all', array(
			'order_id' => $orderId,
		));
		//debug($orderLineItems);
		//debug($cartItemFixture->records);
		$this->assertEquals($expected, $orderLineItems);
		// AND a brand new Customer, User is generated
		// AND brand new addresses for Delivery and BILLING are generated
		// AND the addresses are assigned to the right User
		// AND the addresses are assigned to the right Order
		// AND the Order is assigned to the right Shop and Customer
		
	}
	
}
