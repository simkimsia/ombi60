<?php
/* Wishlist Test cases generated on: 2010-04-17 12:04:31 : 1271507911*/
App::import('Model', 'Wishlist');

class WishlistTestCase extends CakeTestCase {
	var $fixtures = array('app.wishlist', 'app.customer', 'app.shop', 'app.merchant', 'app.order', 'app.address', 'app.product', 'app.product_image', 'app.order_line_item', 'app.webpage', 'app.cart', 'app.cart_item', 'app.page_type', );

	function startTest() {
		$this->Wishlist =& ClassRegistry::init('Wishlist');
	}

	function endTest() {
		unset($this->Wishlist);
		ClassRegistry::flush();
	}

}
?>