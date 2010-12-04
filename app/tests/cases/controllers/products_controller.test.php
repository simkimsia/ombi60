<?php
/* Products Test cases generated on: 2010-04-17 12:04:00 : 1271508960*/
App::import('Controller', 'Products');

class TestProductsController extends ProductsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.product', 'app.shop', 'app.merchant', 'app.customer', 'app.cart', 'app.cart_item', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.webpage', 'app.product_image', 'app.page_type', 'app.user', 'app.group', );

	function startTest() {
		$this->Products =& new TestProductsController();
		$this->Products->constructClasses();
	}

	function endTest() {
		unset($this->Products);
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