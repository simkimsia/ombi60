<?php
/* Language Test cases generated on: 2010-09-03 06:09:28 : 1283487028*/
App::import('Model', 'Language');

class LanguageTestCase extends CakeTestCase {
	var $fixtures = array('app.language', 'app.user', 'app.group', 'app.customer', 'app.shop', 'app.theme', 'app.saved_theme', 'app.merchant', 'app.shops_payment_module', 'app.payment_module', 'app.payment', 'app.order', 'app.address', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order_line_item', 'app.domain', 'app.blog', 'app.post', 'app.comment', 'app.webpage', 'app.wishlist');

	function startTest() {
		$this->Language =& ClassRegistry::init('Language');
	}

	function endTest() {
		unset($this->Language);
		ClassRegistry::flush();
	}

}
?>