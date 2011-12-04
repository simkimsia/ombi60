<?php
/* Customers Test cases generated on: 2010-04-17 12:04:56 : 1271508236*/
App::import('Controller', 'Customers');

class TestCustomersController extends CustomersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CustomersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.customer', 'app.shop', 'app.merchant', 'app.order', 'app.address', 'app.product', 'app.product_image', 'app.order_line_item', 'app.webpage', 'app.cart', 'app.cart_item', 'app.wishlist', 'app.page_type', 'app.user', 'app.group', );

	function startTest() {
		$this->Customers =& new TestCustomersController();
		$this->Customers->constructClasses();
	}

	function endTest() {
		unset($this->Customers);
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