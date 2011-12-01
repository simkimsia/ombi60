<?php
/* SavedThemes Test cases generated on: 2010-08-02 10:08:03 : 1280739243*/
App::import('Controller', 'SavedThemes');

class TestSavedThemesController extends SavedThemesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SavedThemesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.saved_theme', 'app.shop', 'app.theme', 'app.customer', 'app.user', 'app.group', 'app.merchant', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.payment', 'app.payment_module', 'app.shops_payment_module', 'app.wishlist', 'app.domain', 'app.webpage', 'app.page_type');

	function startTest() {
		$this->SavedThemes =& new TestSavedThemesController();
		$this->SavedThemes->constructClasses();
	}

	function endTest() {
		unset($this->SavedThemes);
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