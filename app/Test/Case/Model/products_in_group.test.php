<?php
/* ProductsInGroup Test cases generated on: 2011-03-26 08:03:13 : 1301129833*/
App::import('Model', 'ProductsInGroup');

class ProductsInGroupTestCase extends CakeTestCase {
	var $fixtures = array('app.products_in_group', 'app.product', 'app.shop', 'app.saved_theme', 'app.theme', 'app.recurring_payment_profile', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.casual_surfer', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.cart', 'app.cart_item', 'app.order', 'app.address', 'app.country', 'app.shipped_to_country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate', 'app.order_line_item', 'app.payment', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.paypal_payment_module', 'app.paypal_payers_payment', 'app.paypal_payer', 'app.shipment', 'app.webpage', 'app.wishlist', 'app.domain', 'app.product_image', 'app.product_group');

	function startTest() {
		$this->ProductsInGroup =& ClassRegistry::init('ProductsInGroup');
	}

	function endTest() {
		unset($this->ProductsInGroup);
		ClassRegistry::flush();
	}

}
?>