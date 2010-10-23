<?php
/* Payment Test cases generated on: 2010-06-08 08:06:13 : 1275980233*/
App::import('Model', 'Payment');

class PaymentTestCase extends CakeTestCase {
	var $fixtures = array('app.payment', 'app.payment_module', 'app.order', 'app.shop', 'app.theme', 'app.customer', 'app.user', 'app.group', 'app.merchant', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.address', 'app.wishlist', 'app.domain', 'app.webpage', 'app.page_type', 'app.order_line_item');

	function startTest() {
		$this->Payment =& ClassRegistry::init('Payment');
	}

	function endTest() {
		unset($this->Payment);
		ClassRegistry::flush();
	}

}
?>