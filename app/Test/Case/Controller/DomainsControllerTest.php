<?php
/* Domains Test cases generated on: 2010-05-01 11:05:00 : 1272714120*/
App::import('Controller', 'Domains');

class TestDomainsController extends DomainsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DomainsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.domain', 'app.shop', 'app.customer', 'app.user', 'app.group', 'app.merchant', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.webpage', 'app.page_type');

	function startTest() {
		$this->Domains =& new TestDomainsController();
		$this->Domains->constructClasses();
	}

	function endTest() {
		unset($this->Domains);
		ClassRegistry::flush();
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