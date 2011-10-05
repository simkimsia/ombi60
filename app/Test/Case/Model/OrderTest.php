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
	public function testShouldGetValidOrderIdUsingCreateFrom() {
				
				$count = $this->User->Customer->find('count', array(
					'conditions'=>array(
						'Customer.shop_id'	=> 2,
						'User.group_id'		=> CUSTOMERS,
						'User.email' 		=> 'fake_customer@gmail.com',
					),
					'fields' =>'User.id',
				));
				
				debug($count);
			//	die();
				
		$orderFormData = array(
			// attached inside CartsController/create_order
			'Order' => array(
				'cart_id' => '4e895a91-b374-4a1a-947c-0b701507707a',
				'shop_id' => '2'
			),
			// comes from the actual view
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
			'DeliveryAddress' => array(
				'same' => true,
			),
			'User' => array(
				'email' =>  'fake_customer@gmail.com',
			)
			
		);
		
		$orderId = $this->Order->createFrom($orderFormData);
		debug($orderId);
		$this->assertTrue(is_string($orderId));
		$this->assertTrue(strlen($orderId), 36);
		
	}
	
}
