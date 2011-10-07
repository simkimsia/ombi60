<?php
/* Orders Test cases generated on: 2011-09-01 13:38:15 : 1314884295*/
App::uses('OrdersController', 'Controller');
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('Cart', 'Model');
App::uses('Order', 'Model');

/**
 * CoursesController Test Case
 *
 */
class OrdersControllerTestCase extends ControllerTestCase {
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
		'app.vendor', 'app.country','app.shipped_to_country',
		'app.shipment','app.payment_module',
		'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate',
		'app.payment'
	);

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();
		$this->controller = $this->generate('Orders', array(
			'methods' => array('redirect', 'forceSSL'), 
			'components' => array(
				'Auth' => array('user'), 
				'Security',
				'Session',
				'Cookie'
			)
		));
		
		$this->Shop 	= ClassRegistry::init('Shop');
		$this->User 	= ClassRegistry::init('User');
		$this->Cart		= ClassRegistry::init('Cart');
		$this->Order	= ClassRegistry::init('Order');
		
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
		unset($this->Shop);
		unset($this->User);
		unset($this->Cart);
		unset($this->Order);
		
		ClassRegistry::flush();
		
		// this is to allow User singleton to work properly
		Configure::write('run_test', false);

		parent::tearDown();
	}


	/**
	* 
	* test View Cart 
	**/
	
	public function testPay() {
		$ordersFixture 	= new OrderFixture();
		$order_uuid 	= $ordersFixture->records[0]['id'];
		
		$pageUrl = '/orders/2/' . $order_uuid . '/pay';
		
		$this->testAction($pageUrl, array(
			'return' => 'contents',
			'method' => 'GET'
		));		
		
		$this->assertRegexp('#You are using our secure server#', $this->contents);
		
	}	

	
}
?>