<?php
/* CartItem Test cases generated on: 2010-04-17 12:04:03 : 1271507703*/
App::import('Model', 'CartItem');

class CartItemTestCase extends CakeTestCase {
	var $fixtures = array('app.cart_item', 'app.cart', 'app.customer', 'app.shop', 'app.merchant', 'app.order', 'app.address', 'app.product', 'app.product_image', 'app.order_line_item', 'app.webpage', 'app.wishlist', 'app.page_type', );

	function startTest() {
		$this->CartItem =& ClassRegistry::init('CartItem');
	}

	function endTest() {
		unset($this->CartItem);
		ClassRegistry::flush();
	}

}
?>