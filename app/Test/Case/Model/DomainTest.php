<?php
/* Domain Test cases generated on: 2010-05-01 11:05:36 : 1272714216*/
App::import('Model', 'Domain');

class DomainTestCase extends CakeTestCase {
	var $fixtures = array('app.domain', 'app.shop', 'app.customer', 'app.user', 'app.group', 'app.merchant', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.webpage', 'app.page_type');

	function startTest() {
		$this->Domain =& ClassRegistry::init('Domain');
	}

	function endTest() {
		unset($this->Domain);
		ClassRegistry::flush();
	}

}
?>