<?php
/* Fulfillment Test cases generated on: 2012-02-18 08:50:52 : 1329555052*/
App::uses('Fulfillment', 'Model');

/**
 * Fulfillment Test Case
 *
 */
class FulfillmentTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.fulfillment', 'app.order', 'app.shop', 'app.saved_theme', 'app.theme', 'app.shop_setting', 'app.recurring_payment_profile', 'app.invoice', 'app.subscription_plan', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.cart', 'app.cart_item', 'app.variant', 'app.product', 'app.vendor', 'app.product_type', 'app.product_image', 'app.link', 'app.link_list', 'app.blog', 'app.post', 'app.comment', 'app.webpage', 'app.products_in_group', 'app.product_group', 'app.smart_collection_condition', 'app.order_line_item', 'app.variant_option', 'app.casual_surfer', 'app.merchant', 'app.address', 'app.country', 'app.shipped_to_country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate', 'app.wishlist', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.paypal_payment_module', 'app.payment', 'app.domain', 'app.shipment');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Fulfillment = ClassRegistry::init('Fulfillment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Fulfillment);

		parent::tearDown();
	}

}
