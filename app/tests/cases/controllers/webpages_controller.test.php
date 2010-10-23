<?php
/* Webpages Test cases generated on: 2010-04-19 02:04:35 : 1271645315*/
App::import('Controller', 'Webpages');

class TestWebpagesController extends WebpagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class WebpagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.webpage', 'app.shop', 'app.merchant', 'app.customer', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.page_type', 'app.user', 'app.group', );

	function startTest() {
		$this->Webpages =& new TestWebpagesController();
		$this->Webpages->constructClasses();
	}

	function endTest() {
		unset($this->Webpages);
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

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>