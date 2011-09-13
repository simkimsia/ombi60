<?php
/* Orders Test cases generated on: 2010-04-17 12:04:24 : 1271508264*/
App::import('Controller', 'Orders');

class TestOrdersController extends OrdersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class OrdersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.order', 'app.shop', 'app.merchant', 'app.customer', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.wishlist', 'app.webpage', 'app.address', 'app.order_line_item', 'app.page_type', 'app.user', 'app.group', );

	function startTest() {
		$this->Orders =& new TestOrdersController();
		$this->Orders->constructClasses();
	}

	function endTest() {
		unset($this->Orders);
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