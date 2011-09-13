<?php
/* Theme Test cases generated on: 2010-05-11 07:05:54 : 1273561794*/
App::import('Model', 'Theme');

class ThemeTestCase extends CakeTestCase {
	var $fixtures = array('app.theme', 'app.shop', 'app.customer', 'app.user', 'app.group', 'app.merchant', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.domain', 'app.webpage', 'app.page_type');

	function startTest() {
		$this->Theme =& ClassRegistry::init('Theme');
	}

	function endTest() {
		unset($this->Theme);
		ClassRegistry::flush();
	}

}
?>