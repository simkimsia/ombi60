<?php
/* Courses Test cases generated on: 2011-09-01 13:38:15 : 1314884295*/
App::uses('WebpagesController', 'Controller');

/**
 * CoursesController Test Case
 *
 */
class WebpagesControllerTestCase extends ControllerTestCase {
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
		'app.paypal_payment_module',
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
		
		$this->Shop 	= ClassRegistry::init('Shop');
		$this->User 	= ClassRegistry::init('User');
		
		$cachedShopId = Shop::get('Shop.id');
		
		if ($cachedShopId != 2) {
			$testShop = $this->Shop->getById(2);
			Shop::store($testShop);
		}
		
		$cachedUserId = User::get('User.id');

		if($cachedUserId !== 1) {
			$user = $this->User->getMerchantUser(1);
			User::store($user);
		}
		
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
		
		ClassRegistry::flush();
		
		// this is to allow User singleton to work properly
		Configure::write('run_test', false);

		parent::tearDown();
	}

	/**
	 * testIndex method
	 *
	 * @return void
	 */
	public function testAdminIndex() {
		$this->controller = $this->generate('Webpages', array(
			'methods' => array('forceSSL'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		$this->testAction('/admin/pages/index', array('return' => 'contents'));
		
		$this->assertRegexp('#<h2>Pages</h2>#', $this->contents);
		$this->assertRegexp('#<h2>Blogs</h2>#', $this->contents);
	}

	/**
	 * testView method
	 *
	 * @return void
	 */
	public function testAdminView() {
		$this->controller = $this->generate('Webpages', array(
			'methods' => array('forceSSL'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		$this->testAction('/admin/pages/view/2', array('return' => 'contents'));
		$expected = '#<h2>Welcome</h2>#';

		$this->assertRegexp($expected, $this->contents);
	}

	public function testAdminAdd() {
		$this->controller = $this->generate('Webpages', array(
			'methods' => array('forceSSL'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		$fixture = new WebpageFixture();	
		$this->controller->request->data['Webpage'] = $fixture->records[1];
		unset($this->controller->request->data['Webpage']['id']);
		$this->assertFlash($this->controller, 'The webpage has been saved');
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$this->testAction('/admin/pages/add', array('data' => $this->controller->request->data, 'method' => 'POST'));
	}

	public function testAdminEdit() {
		$this->controller = $this->generate('Webpages', array(
					'methods' => array('forceSSL'), 
					'components' => array('Auth' => array('user'), 'Security')
		));
		$fixture = new WebpageFixture();
		$this->controller->request->data['Webpage'] = $fixture->records[1];
		$this->controller->request->data['Webpage']['title'] = "Test2";
		$this->assertFlash($this->controller, 'The webpage has been saved');
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$this->testAction('/admin/pages/edit/2', array('data' => $this->controller->request->data, 'method' => 'POST'));
	}

	public function testAdminDelete() {
		$this->controller = $this->generate('Webpages', array(
					'methods' => array('forceSSL'), 
					'components' => array('Auth' => array('user'), 'Security')
		));
		$this->assertFlash($this->controller, 'Webpage deleted');
		$this->testAction('/admin/pages/delete/3');
	}

}
?>