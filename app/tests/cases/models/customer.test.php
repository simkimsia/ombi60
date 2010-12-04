<?php
/* Customer Test cases generated on: 2010-04-17 12:04:36 : 1271507736*/
App::import('Model', 'Customer');

class CustomerTestCase extends CakeTestCase {
	var $fixtures = array('app.customer', 'app.shop', 'app.merchant', 'app.order', 'app.address', 'app.product', 'app.product_image', 'app.order_line_item', 'app.webpage', 'app.cart', 'app.cart_item', 'app.wishlist', 'app.page_type', );

	function startTest() {
		$this->Customer =& ClassRegistry::init('Customer');
	}

	function endTest() {
		unset($this->Customer);
		ClassRegistry::flush();
	}

}
?>