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
		

		$expectedDate 	= date('Y-m-d H:i:s');
		$publishedDate 	= $result['Post']['published'];
		
		$publishedDateTime 	= new DateTime($publishedDate);
		$expectedDateTime 	= new DateTime($expectedDate);
		
		$interval =  $expectedDateTime->diff($publishedDateTime);
		
		// AND the published datetime is within a 2 second timespan from the expected datetime		
		$this->assertTrue(($interval->s <= 2));
		$this->assertTrue(($interval->s >= 0));
		
	}
	


	
}
