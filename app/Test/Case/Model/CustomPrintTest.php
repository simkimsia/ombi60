<?php
App::uses('CustomPrint', 'Model');

/**
 * CustomPrint Test Case
 *
 */
class CustomPrintTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.custom_print', 'app.product', 'app.shop', 'app.saved_theme', 'app.theme', 'app.shop_setting', 'app.recurring_payment_profile', 'app.invoice', 'app.subscription_plan', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.cart', 'app.cart_item', 'app.variant', 'app.order_line_item', 'app.order', 'app.address', 'app.country', 'app.shipped_to_country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate', 'app.payment', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.paypal_payment_module', 'app.shipment', 'app.fulfillment', 'app.product_image', 'app.variant_option', 'app.casual_surfer', 'app.merchant', 'app.post', 'app.blog', 'app.link', 'app.link_list', 'app.webpage', 'app.comment', 'app.wishlist', 'app.domain', 'app.product_group', 'app.products_in_group', 'app.smart_collection_condition', 'app.vendor', 'app.product_type');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CustomPrint = ClassRegistry::init('CustomPrint');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CustomPrint);

		parent::tearDown();
	}

}
