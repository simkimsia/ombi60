<?php
/* Variant Test cases generated on: 2011-06-10 23:06:11 : 1307746871*/
App::import('Model', 'Variant');

class VariantTestCase extends CakeTestCase {
	var $fixtures = array('app.variant', 'app.product', 'app.shop', 'app.saved_theme', 'app.theme', 'app.shop_setting', 'app.recurring_payment_profile', 'app.invoice', 'app.subscription_plan', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.casual_surfer', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.cart', 'app.cart_item', 'app.order', 'app.address', 'app.country', 'app.shipped_to_country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate', 'app.order_line_item', 'app.payment', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.paypal_payment_module', 'app.paypal_payers_payment', 'app.paypal_payer', 'app.shipment', 'app.webpage', 'app.wishlist', 'app.domain', 'app.link_list', 'app.link', 'app.product_group', 'app.products_in_group', 'app.vendor', 'app.product_image');

	function startTest() {
		$this->Variant =& ClassRegistry::init('Variant');
	}

	function endTest() {
		unset($this->Variant);
		ClassRegistry::flush();
	}

}
?>