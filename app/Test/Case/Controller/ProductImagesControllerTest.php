<?php
/* ProductImages Test cases generated on: 2010-04-17 12:04:10 : 1271508970*/
App::import('Controller', 'ProductImages');

class TestProductImagesController extends ProductImagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProductImagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.product_image', 'app.product', 'app.shop', 'app.merchant', 'app.customer', 'app.cart', 'app.cart_item', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.webpage', 'app.page_type', 'app.user', 'app.group', );

	function startTest() {
		$this->ProductImages =& new TestProductImagesController();
		$this->ProductImages->constructClasses();
	}

	function endTest() {
		unset($this->ProductImages);
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