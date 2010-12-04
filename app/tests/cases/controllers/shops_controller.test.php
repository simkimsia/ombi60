<?php
/* Shops Test cases generated on: 2010-04-17 12:04:16 : 1271508976*/
App::import('Controller', 'Shops');

class TestShopsController extends ShopsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ShopsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.shop', 'app.merchant', 'app.customer', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.webpage', 'app.page_type', 'app.user', 'app.group', );

	function startTest() {
		$this->Shops =& new TestShopsController();
		$this->Shops->constructClasses();
	}

	function endTest() {
		unset($this->Shops);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>