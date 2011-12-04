<?php
/* PaypalPayer Test cases generated on: 2011-01-01 11:01:04 : 1293879904*/
App::import('Model', 'PaypalPayer');

class PaypalPayerTestCase extends CakeTestCase {
	var $fixtures = array('app.paypal_payer', 'app.paypal_payers_payment', 'app.payment', 'app.shops_payment_module', 'app.shop', 'app.saved_theme', 'app.theme', 'app.recurring_payment_profile', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.casual_surfer', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order_line_item', 'app.order', 'app.address', 'app.country', 'app.shipped_to_country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate', 'app.shipment', 'app.webpage', 'app.wishlist', 'app.domain', 'app.payment_module', 'app.custom_payment_module', 'app.paypal_payment_module');

	function startTest() {
		$this->PaypalPayer =& ClassRegistry::init('PaypalPayer');
	}

	function endTest() {
		unset($this->PaypalPayer);
		ClassRegistry::flush();
	}

}
?>