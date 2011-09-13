<?php
/* ShippedToCountry Test cases generated on: 2010-09-09 09:09:33 : 1284017673*/
App::import('Model', 'ShippedToCountry');

class ShippedToCountryTestCase extends CakeTestCase {
	var $fixtures = array('app.shipped_to_country', 'app.country', 'app.shipping_rate', 'app.shop', 'app.theme', 'app.saved_theme', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.webpage', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.payment', 'app.payment_module', 'app.shops_payment_module', 'app.custom_payment_module', 'app.wishlist', 'app.domain', 'app.price_based_rate', 'app.weight_based_rate');

	function startTest() {
		$this->ShippedToCountry =& ClassRegistry::init('ShippedToCountry');
	}

	function endTest() {
		unset($this->ShippedToCountry);
		ClassRegistry::flush();
	}

}
?>