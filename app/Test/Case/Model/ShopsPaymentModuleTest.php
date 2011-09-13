<?php
/* ShopsPaymentModule Test cases generated on: 2010-06-10 02:06:01 : 1276131481*/
App::import('Model', 'ShopsPaymentModule');

class ShopsPaymentModuleTestCase extends CakeTestCase {
	var $fixtures = array('app.shops_payment_module', 'app.shop', 'app.theme', 'app.customer', 'app.user', 'app.group', 'app.merchant', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.payment', 'app.payment_module', 'app.wishlist', 'app.domain', 'app.webpage', 'app.page_type');

	function startTest() {
		$this->ShopsPaymentModule =& ClassRegistry::init('ShopsPaymentModule');
	}

	function endTest() {
		unset($this->ShopsPaymentModule);
		ClassRegistry::flush();
	}

}
?>