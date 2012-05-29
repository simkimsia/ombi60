<?php
/* Carts Test cases generated on: 2011-09-01 13:38:15 : 1314884295*/
App::uses('CartsController', 'Controller');
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('Cart', 'Model');
App::uses('Order', 'Model');

/**
 * CoursesController Test Case
 *
 */
class CartsControllerTestCase extends ControllerTestCase {
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
		'app.product', 'app.product_image', 'app.wishlist', 'app.custom_print', 
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
		$this->controller = $this->generate('Carts', array(
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


	private function setUpForEmptyCart() {
		$this->Cart->query('TRUNCATE table `carts`');
		$this->Cart->query('TRUNCATE table `cart_items`');
		$this->User->id = 2;
		$this->User->saveField('live_cart_id', NULL);
		
		$noOfCarts = $this->Cart->find('count', array(
			'conditions' => array('Cart.user_id' => 2)
		));
		$this->assertEquals($noOfCarts, 0);
	}

	/**
	* 
	* test View Cart 
	**/
	
	public function testEmptyViewCart() {
		//Given Cart is empty
		$this->setUpForEmptyCart();
		
		// @TODO $this->testAction('/cart', array('return' => 'contents'));		
		// @TODO $this->assertRegexp('#<p id="empty">Your shopping cart is empty#', $this->contents);
		
	}
	
	/**
	* 
	* test View Cart 
	**/
	
	public function testViewCart() {
		
		// Given Cart is NOT empty
		/*
		$this->testAction('/cart', array('return' => 'contents'));		
		$this->assertRegexp('#name="checkout"#', $this->contents);
		$this->assertRegexp('#name="update"#', $this->contents);
		*/
	}	
	
	/**
	* 
	* test add_to_cart action in carts
	*
	
	public function testAddToCart() {
			
		$this->controller->request->data['id'] = 3;
		$this->assertFlash($this->controller, 'Product added to cart');
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$this->testAction('/cart/add', array(
			'data' => $this->controller->request->data, 
			'method' => 'POST'
		));
		
	}
	**/
	/**
	* 
	* test change_qty_for_1_item_in_cart
	*
	**/
	public function testChangeQtyFor1ItemInCart() {
		$this->controller->expects($this->once())->method('redirect')->with(array('action' => 'view_cart'))->will($this->returnValue(true));
		$this->testAction('/cart/change/3?quantity=0');
		
	}
	
	/**
	*
	* test checkout button in cart page
	**/
	public function testCheckoutButtonInCart() {
		
		// press the checkout button
		$this->controller->request->data['checkout'] = 1;
		
		$cartId = User::get('User.live_cart_id');
		
		$this->controller->expects($this->once())->method('redirect')->with(array('action' => 'redirectem', '0' => '2', '1' => $cartId))->will($this->returnValue(true));
		$this->testAction('/cart', array(
			'data' => $this->controller->request->data, 
			'method' => 'POST'
		));
		
	}
	
	/**
	* 
	* test add to cart
	*
	**/
	public function testCheckoutPage1View() {
	
		$string = '/carts/2/' . User::get('User.live_cart_id');

		/* @TODO $this->testAction($string, array(
			'return' => 'contents',
			'method' => 'GET'
		));
*/
		// @TODO $this->assertRegexp('#You are using our secure server#', $this->contents);
		
	}	

	
}
?>