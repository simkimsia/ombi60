<?php
/* Cart Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('LinkList', 'Model');

/**
 * LinkList Test Case
 *
 */
class LinkListTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 *
	 **/
	public $fixtures = array(
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

		$this->LinkList = ClassRegistry::init('LinkList');
		
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
		unset($this->LinkList);
		unset($this->Shop);
		unset($this->User);
		ClassRegistry::flush();

		parent::tearDown();
	}
		
	
	/**
	 * saveAll should successfully convert all links before saving
	 * successful result returned
	 *
	 * @return void
	 *
	 **/
	public function testSaveAllShouldSuccessfullyConvertAllLinkLists() {
		
		// GIVEN all current links in fixture
		$linkFixture = new LinkFixture();
		$relatedLinks = $linkFixture->records;
		unset($relatedLinks[5]);
		unset($relatedLinks[6]);
		
		$linkListFixture = new LinkListFixture();
		$mainMenuList	 = $linkListFixture->records[0];
		
		$data = array(
			'LinkList' => $mainMenuList,
			'Link' 		=> $relatedLinks
		);
		
		// AND we make change to 1 of the links
		$data['Link'][0]['name'] = 'Home1';
		
		// WHEN we run saveALL
		$result = $this->LinkList->saveAll($data);
		
		// THEN the links are changed accordingly
		$this->assertTrue($result);
		
		// AND the links change
		$expected = array(
			'Link' => 
				array(
					'id' => '1',
					'name' => 'Home1',
					'route' => '/',
					'link_list_id' => '1',
					'model' => '/',
					'action' => '',
					'order' => '0',
					'parent_model' => NULL,
					'parent_id' => '0'
				),
		);
		$this->LinkList->Link->recursive = -1;
		$actual = $this->LinkList->Link->read(null, 1);
		
		$this->assertEquals($expected, $actual);
	}
	
	
}
