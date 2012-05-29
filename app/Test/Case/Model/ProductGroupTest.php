<?php
/* Product Test cases generated on: 2011-09-22 09:42:11 : 1316684531*/
App::uses('ProductGroup', 'Model');
App::uses('Shop', 'Model');

/**
 * Product Test Case
 *
 */
class ProductGroupTestCase extends CakeTestCase {
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

		$this->ProductGroup 	= ClassRegistry::init('ProductGroup');
		$this->Shop 			= ClassRegistry::init('Shop');
		
		$cachedShopId = Shop::get('Shop.id');
		
		if ($cachedShopId != 2) {
			$testShop = $this->Shop->getById(2);
			Shop::store($testShop);
		}
		
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductGroup);
		unset($this->Shop);
		ClassRegistry::flush();
		
		// consider running cake shell code to destroy image file and thumbs

		parent::tearDown();
	}
	
	/**
	* test that at least collections has CollectionsWith some products
	**/
	public function testPrepareGlobalCollectionsWithProductsShouldWork() {
		// GIVEN we test shop 2
		$shop_id = 2;
		
		// WHEN we run the function
		$result = $this->ProductGroup->prepareGlobalCollectionsWithProducts($shop_id);
		
		// THEN we get back at least 3 regular collections  + 'all'
		$this->assertEqual(4, count($result));

		// AND collection 1 has product 2 only
		$this->assertTrue(is_array($result['frontpage']['products']['dummy_product']));
		$this->assertTrue(!empty($result['frontpage']['products']['dummy_product']));
		
		// AND collection 2 has product 2 and 3
		$this->assertTrue(is_array($result['smart_collection_1']['products']['dummy_product']));
		$this->assertTrue(!empty($result['smart_collection_1']['products']['dummy_product']));
		
		$this->assertTrue(is_array($result['smart_collection_1']['products']['test_product_with_no_pic_and_no_collection']));
		$this->assertTrue(!empty($result['smart_collection_1']['products']['test_product_with_no_pic_and_no_collection']));
		
		// AND collection 'all' has product 2 and 3
		$this->assertTrue(is_array($result['all']['products']['dummy_product']));
		$this->assertTrue(!empty($result['all']['products']['dummy_product']));
		
		$this->assertTrue(is_array($result['all']['products']['test_product_with_no_pic_and_no_collection']));
		$this->assertTrue(!empty($result['all']['products']['test_product_with_no_pic_and_no_collection']));
	}
	
}