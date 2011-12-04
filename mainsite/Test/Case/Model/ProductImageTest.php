<?php
/* ProductImage Test cases generated on: 2010-04-17 12:04:18 : 1271507898*/
App::import('Model', 'ProductImage');

class ProductImageTestCase extends CakeTestCase {
	var $fixtures = array('app.product_image', 'app.product', 'app.shop', 'app.merchant', 'app.customer', 'app.cart', 'app.cart_item', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.webpage', 'app.page_type', );

	function startTest() {
		$this->ProductImage =& ClassRegistry::init('ProductImage');
	}

	function endTest() {
		unset($this->ProductImage);
		ClassRegistry::flush();
	}

}
?>