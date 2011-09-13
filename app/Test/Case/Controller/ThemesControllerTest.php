<?php
/* Themes Test cases generated on: 2010-05-11 07:05:11 : 1273561811*/
App::import('Controller', 'Themes');

class TestThemesController extends ThemesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ThemesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.theme', 'app.shop', 'app.customer', 'app.user', 'app.group', 'app.merchant', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.domain', 'app.webpage', 'app.page_type');

	function startTest() {
		$this->Themes =& new TestThemesController();
		$this->Themes->constructClasses();
	}

	function endTest() {
		unset($this->Themes);
		ClassRegistry::flush();
	}

}
?>