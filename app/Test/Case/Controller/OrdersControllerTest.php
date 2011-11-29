<?php
/* Orders Test cases generated on: 2011-09-01 13:38:15 : 1314884295*/
App::uses('OrdersController', 'Controller');
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('Cart', 'Model');
App::uses('Order', 'Model');
App::uses('PaypalPaymentModule', 'Model');

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
		'app.aro', 'app.aco', 'app.aros_aco',
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
		'app.payment', 'app.shops_payment_module', 'app.paypal_payment_module',
		'app.custom_payment_module',
		'app.payment_module',
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
	public function testPayShouldDisplayContentsProperly() {
		$ordersFixture 	= new OrderFixture();
		$order_uuid 	= $ordersFixture->records[0]['id'];
		
		$pageUrl = '/orders/2/' . $order_uuid . '/pay';
		
		$this->testAction($pageUrl, array(
			'return' => 'contents',
			'method' => 'GET'
		));		
		
		$this->assertRegexp('#You are using our secure server#', $this->contents);
		
	}
	
	/**
	* 
	* test complete purchase redirect properly
	**/
	public function testCompletePurchaseShouldRedirectProperly() {
		$ordersFixture 	= new OrderFixture();
		$order_uuid 	= $ordersFixture->records[0]['id'];
		
		$pageUrl = '/orders/2/' . $order_uuid . '/complete_purchase';
		
		$data = array(
			'Payment' => array(
				'shops_payment_module_id' => 1,
			),
			'Shipment' => array(
				'shipping_rate_id' => 7,
			)
		);
		
		$this->controller->request->data = $data;
		
		$this->controller->expects($this->once())->method('redirect')->with(array('action' => 'completed', 'shop_id' => '2', 'order_uuid' => $order_uuid))->will($this->returnValue(true));
		
		$this->testAction($pageUrl, array(
			'return' => 'contents',
			'method' => 'POST',
			'data' => $this->controller->request->data,
		));		
		
	}
	
	/**
	* 
	* test Purchase completed page
	**/
	public function testCompletdShouldDisplayContentsProperly() {
		$ordersFixture 	= new OrderFixture();
		$order_uuid 	= $ordersFixture->records[0]['id'];
		
		$shopFixture 	= new ShopFixture();
		$shopDomain		= $shopFixture->records[1]['primary_domain'];
		
		$pageUrl = '/orders/2/' . $order_uuid . '/completed';
		
		$this->testAction($pageUrl, array(
			'return' => 'contents',
			'method' => 'GET'
		));		
		
		$this->assertRegexp('#Successful transaction! You may return back to your <a href="'.$shopDomain.'">shopping</a>#', $this->contents);
		
	}

	
}
?>