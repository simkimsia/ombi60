<?php
/* Order Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('Post', 'Model');

/**
 * Order Test Case
 *
 */
class PostTestCase extends CakeTestCase {
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
		'app.vendor', 'app.country', 'app.payment'
	);


/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Post = ClassRegistry::init('Post');
		
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
		unset($this->Post);
		unset($this->Shop);
		unset($this->User);
		ClassRegistry::flush();

		parent::tearDown();
	}	
	
	/**
	*
	* test getOptionsForCheckout Should reveal relevant options
	*
	**/
	public function testUpdatePublishedAt() {
		// GIVEN that we want to update the published at datetime
		
		// WHEN we run the function
		$result = $this->Post->updatePublishedAt(1);
		
		// THEN we get success
		$this->assertTrue($result);
		
		// AND we get a datetime in the POST
		$this->Post->recursive = -1;
		$result = $this->Post->read(array('Post.published'), 1);
		$date 	= date('Y-m-d H:i:s');
		$publishedDate = $result['Post']['published'];
		$this->assertEquals($date, $publishedDate);
		
		/*
		$array = explode(" ", $publishedDate);

		$this->assertEquals($date, $array[0]);*/
		
	}
	


	
}
