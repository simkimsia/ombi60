<?php
/* OrderLineItem Test cases generated on: 2010-04-17 12:04:24 : 1271507844*/
App::import('Model', 'OrderLineItem');

class OrderLineItemTestCase extends CakeTestCase {
	var $fixtures = array('app.order_line_item', 'app.order', 'app.shop', 'app.merchant', 'app.customer', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.wishlist', 'app.webpage', 'app.address', 'app.page_type', );

	function startTest() {
		$this->OrderLineItem =& ClassRegistry::init('OrderLineItem');
	}

	function endTest() {
		unset($this->OrderLineItem);
		ClassRegistry::flush();
	}

}
?>