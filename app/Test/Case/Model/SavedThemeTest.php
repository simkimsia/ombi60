<?php
/* SavedTheme Test cases generated on: 2010-08-02 10:08:27 : 1280738847*/
App::import('Model', 'SavedTheme');

class SavedThemeTestCase extends CakeTestCase {
	var $fixtures = array('app.saved_theme', 'app.shop', 'app.theme', 'app.customer', 'app.user', 'app.group', 'app.merchant', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.payment', 'app.payment_module', 'app.shops_payment_module', 'app.wishlist', 'app.domain', 'app.webpage', 'app.page_type');

	function startTest() {
		$this->SavedTheme =& ClassRegistry::init('SavedTheme');
	}

	function endTest() {
		unset($this->SavedTheme);
		ClassRegistry::flush();
	}

}
?>