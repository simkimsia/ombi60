<?php
/* Carts Test cases generated on: 2010-04-17 12:04:24 : 1271509104*/
App::import('Controller', 'Carts');

class TestCartsController extends CartsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CartsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.cart', 'app.customer', 'app.shop', 'app.merchant', 'app.order', 'app.address', 'app.product', 'app.product_image', 'app.order_line_item', 'app.webpage', 'app.wishlist', 'app.cart_item', 'app.page_type', 'app.user', 'app.group', );

	function startTest() {
		$this->Carts =& new TestCartsController();
		$this->Carts->constructClasses();
	}

	function endTest() {
		unset($this->Carts);
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