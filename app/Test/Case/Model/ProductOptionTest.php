<?php
/* ProductOption Test cases generated on: 2011-06-19 21:06:26 : 1308519926*/
App::import('Model', 'ProductOption');

class ProductOptionTestCase extends CakeTestCase {
	var $fixtures = array('app.product_option', 'app.product', 'app.shop', 'app.saved_theme', 'app.theme', 'app.shop_setting', 'app.recurring_payment_profile', 'app.invoice', 'app.subscription_plan', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.casual_surfer', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.cart', 'app.cart_item', 'app.order', 'app.address', 'app.country', 'app.shipped_to_country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate', 'app.order_line_item', 'app.payment', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.paypal_payment_module', 'app.paypal_payers_payment', 'app.paypal_payer', 'app.shipment', 'app.webpage', 'app.wishlist', 'app.domain', 'app.link_list', 'app.link', 'app.product_group', 'app.products_in_group', 'app.smart_collection_condition', 'app.vendor', 'app.product_type', 'app.product_image', 'app.variant', 'app.variant_option');

	function startTest() {
		$this->ProductOption =& ClassRegistry::init('ProductOption');
	}

	function endTest() {
		unset($this->ProductOption);
		ClassRegistry::flush();
	}

}
?>