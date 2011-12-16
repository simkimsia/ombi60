<?php
/* Cart Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('CasualSurfer', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * CasualSurfer Test Case
 *
 */
class CasualSurferTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 *
	 **/
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
		'app.log', 'app.saved_theme', 'app.theme',
		'app.country',
		'app.shipment', 'app.shipping_rate', 'app.shipped_to_country',	
		'app.price_based_rate', 'app.weight_based_rate',
		'app.invoice', 'app.recurring_payment_profile',	
	);

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->CasualSurfer = ClassRegistry::init('CasualSurfer');
		
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
		unset($this->CasualSurfer);
		unset($this->Shop);
		unset($this->User);
		ClassRegistry::flush();

		parent::tearDown();
	}
		
	
	/**
	 * createNew should return new User id
	 * New User created
	 * New Casual Surfer created
	 *
	 * @return void
	 *
	 **/
	public function testCreateNewShouldCreateNewUserCasualSurfer() {

		// GIVEN that we have 1 Casual Surfer and 3 User currently
		$count = $this->CasualSurfer->find('count');
		$this->assertEquals(1, $count);

		$count = $this->User->find('count');
		$this->assertEquals(3, $count);
				
		// WHEN we create a brand new CasualSurfer
		$result = $this->CasualSurfer->createNew('randomemail@ombi60.com', 'randompasswordhash');
		
		// THEN we expect the result to be new User id expected to be 4
		$this->assertEquals(4, $result);
		
		// AND we expect new User and Casual Surfer	with new hashed password	
		$passwordHash = AuthComponent::password('randompasswordhash');
		
		$actual = $this->CasualSurfer->find('all', array(
			'conditions' => array(
				'User.email' => 'randomemail@ombi60.com',
				'User.password' => $passwordHash,
			),
			'fields' => array(
				'CasualSurfer.id',
				'CasualSurfer.shop_id',
				'CasualSurfer.user_id'
			)
		));
		
				
		$expected = array(
			array('CasualSurfer' => array(
				'id'		=> 2,
				'shop_id'	=> 2,
				'user_id'	=> 4
			))
		);
		
		$this->assertEquals($expected, $actual);
	}
	

}
