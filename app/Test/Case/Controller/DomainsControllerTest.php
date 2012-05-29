<?php
/* Courses Test cases generated on: 2011-09-01 13:38:15 : 1314884295*/
App::uses('DomainsController', 'Controller');

/**
 * CoursesController Test Case
 *
 */
class DomainsControllerTestCase extends ControllerTestCase {
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
		
		$this->Shop 	= ClassRegistry::init('Shop');
		$this->User 	= ClassRegistry::init('User');
		
		$cachedShopId = Shop::get('Shop.id');
		
		if ($cachedShopId != 2) {
			$testShop = $this->Shop->getById(2);
			Shop::store($testShop);
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
		$this->controller = $this->generate('Domains', array(
			'methods' => array('forceSSL'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		
		$_SERVER['REQUEST_URI'] = '/admin/domains';
		/* // @TODO 
		$this->testAction('/admin/domains', array('return' => 'contents', 'method'=>'GET'));
		*/
		$expected = array('tag' => 'h1', 'content' => 'Domains');
		// @TODO $this->assertTag($expected, $this->contents);

		// @TODO $this->assertRegexp('#<td>http://localhost&nbsp;</td>#', $this->contents);
	}

	/**
	 * testView method
	 *
	 * @return void
	 */
	public function testAdminView() {
		$this->controller = $this->generate('Domains', array(
			'methods' => array('forceSSL'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		$_SERVER['REQUEST_URI'] = '/admin/domains/view/2';
		
		// @TODO $this->testAction('/admin/domains/view/2', array('return' => 'contents'));
		$expected = array('tag' => 'h2', 'content' => 'Domain');
		// @TODO $this->assertTag($expected, $this->contents);
		$expected = array(
			'tag' => 'dl',
			'child' => array(
				'tag' => 'dd',
				'content' => 'http://localhost'
			),
			'children' => array(
				'count' => 8
			)
		);
		// @TODO $this->assertTag($expected, $this->contents);
	}

	function testAdminAdd() {
		$this->controller = $this->generate('Domains', array(
			'methods' => array('forceSSL', 'sendJson'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		$fixture = new DomainFixture();	
		$this->controller->request->data['Domain'] = $fixture->records[1];
		unset($this->controller->request->data['Domain']['id']);
		$this->controller->request->data['Domain']['domain'] = 'http://localhost2';
		$this->assertFlash($this->controller, 'The domain has been saved');
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_SERVER['REQUEST_URI'] = '/admin/domains/add';
		$this->testAction('/admin/domains/add', array('data' => $this->controller->request->data, 'method' => 'POST'));
		//debug($this->controller->Domain->getLastInsertId());
		//die();
	 }

	function testAdminEdit() {
		$this->controller = $this->generate('Domains', array(
					'methods' => array('forceSSL'), 
					'components' => array('Auth' => array('user'), 'Security')
		));
		$fixture = new DomainFixture();
		$this->controller->request->data['Domain'] = $fixture->records[1];
		$this->controller->request->data['Domain']['domain'] = "Test2";
		$this->assertFlash($this->controller, 'The domain has been saved');
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_SERVER['REQUEST_URI'] = '/admin/domains/edit/2';
		$this->testAction('/admin/domains/edit/2', array('data' => $this->controller->request->data, 'method' => 'POST'));
	}

	function testAdminDelete() {
		$this->controller = $this->generate('Domains', array(
					'methods' => array('forceSSL'), 
					'components' => array('Auth' => array('user'), 'Security')
		));
		$this->assertFlash($this->controller, 'Domain deleted');
		$this->testAction('/admin/domains/delete/2');
	}

}
?>
