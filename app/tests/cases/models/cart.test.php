<?php
/* Cart Test cases generated on: 2010-04-17 12:04:42 : 1271507682*/
App::import('Model', 'Cart');

class CartTestCase extends CakeTestCase {
	var $fixtures = array('app.cart', 'app.customer', 'app.shop', 'app.merchant', 'app.order', 'app.address', 'app.product', 'app.product_image', 'app.order_line_item', 'app.webpage', 'app.wishlist', 'app.cart_item' , 'app.page_type', );

	function startTest() {
		$this->Cart =& ClassRegistry::init('Cart');
	}

	function endTest() {
		unset($this->Cart);
		ClassRegistry::flush();
	}

}
?>