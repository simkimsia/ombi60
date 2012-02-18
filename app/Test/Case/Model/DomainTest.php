<?php
/* Domain Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('Domain', 'Model');

/**
 * Domain Test Case
 *
 */
class DomainTestCase extends CakeTestCase {
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

		$this->Domain = ClassRegistry::init('Domain');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Domain);
		ClassRegistry::flush();

		parent::tearDown();
	}

/**
 * testMakeThisPrimary method
 *
 * @return void
 */
	public function testMakeThisPrimary() {
		$primary = $this->Domain->read(null, '2'); //current primary
		$noPrimary = $this->Domain->read(null, '3'); //no primary
		$this->assertTrue($primary['Domain']['primary']);
		$this->assertFalse($noPrimary['Domain']['primary']);
		$this->Domain->makeThisPrimary('3', '2');
		$primary = $this->Domain->read(null, '3'); //new primary
		$noPrimary = $this->Domain->read(null, '2'); //no primary
		$this->assertTrue($primary['Domain']['primary']);
		$this->assertFalse($noPrimary['Domain']['primary']);
	}

}
