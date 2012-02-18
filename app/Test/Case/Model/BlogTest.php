<?php
/* Blog Test cases generated on: 2011-09-22 09:42:11 : 1316684531*/
App::uses('Blog', 'Model');

/**
 * Blog Test Case
 *
 */
class BlogTestCase extends CakeTestCase {
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

		$this->Blog = ClassRegistry::init('Blog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Blog);
		ClassRegistry::flush();

		parent::tearDown();
	}

/**
 * testGetTemplateVariable method
 *
 * @return void
 */
	public function testGetTemplateVariable() {

	}
	
	
	/**
	*
	* this private method should work for the Posts
	*
	**/
	public function testUpdateBlogHandlesInArticlesShouldWork() {
		// possibly use this to test the private method
	}

	/**
	*
	* this private method should work for the Links
	*
	**/
	public function testUpdateLinksShouldWork() {
		// possibly use this to test the private method
	}


}
