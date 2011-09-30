<?php
/* Courses Test cases generated on: 2011-09-01 13:38:15 : 1314884295*/
App::uses('CartsController', 'Controller');
App::uses('User', 'Model');
App::uses('Shop', 'Model');

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
		'app.cart', 'app.customer', 'app.shop', 
		'app.merchant', 'app.order', 'app.address', 
		'app.product', 'app.product_image', 'app.order_line_item', 
		'app.webpage', 'app.wishlist', 'app.cart_item', 
		'app.page_type', 'app.user', 'app.group',
		'app.variant', 'app.variant_option', 'app.products_in_group',
		'app.product_group', 'app.shop_setting', 'app.domain', 
		'app.casual_surfer', 'app.link_list', 'app.link', 
		'app.blog', 'app.post', 'app.comment', 
		'app.shops_payment_module', 'app.log', 'app.saved_theme'
	);

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();
		$this->controller = $this->generate('Carts', array(
			'methods' => array('forceSSL'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		
		$this->Shop 	= ClassRegistry::init('Shop');
		$this->User 	= ClassRegistry::init('User');
		
		$cachedShopId = Shop::get('Shop.id');
		
		if ($cachedShopId != 2) {
			$testShop = $this->Shop->getById(2);
			Shop::store($testShop);
		}
		
		$cachedUserId = User::get('User.id');
		
		if($cachedUserId != 3) {
			User::store($this->User->read(null, $cachedUserId ));
		}
		
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->Shop);
		unset($this->User);
		ClassRegistry::flush();

		parent::tearDown();
	}


	/**
	* 
	* test View Cart 
	*
	**/
	public function testViewCart() {
		
		$this->testAction('/cart', array('return' => 'contents'));		
		$this->assertRegexp('#<p id="empty">Your shopping cart is empty#', $this->contents);
	}
	
	/**
	* 
	* test add_to_cart action in carts
	*
	**/
	public function testAddToCart() {
		
		$fixture = new CartFixture();	
		$this->controller->request->data['id'] = 3;
		$this->assertFlash($this->controller, 'Product added to cart');
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$this->testAction('/cart/add', array(
			'data' => $this->controller->request->data, 
			'method' => 'POST'
		));
		
	}
}
?>