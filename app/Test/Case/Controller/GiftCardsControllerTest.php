<?php
/* GiftCards Test cases generated on: 2010-09-04 14:09:20 : 1283604920*/
App::import('Controller', 'GiftCards');

class TestGiftCardsController extends GiftCardsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class GiftCardsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.gift_card', 'app.shop', 'app.theme', 'app.saved_theme', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.webpage', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.payment', 'app.payment_module', 'app.shops_payment_module', 'app.wishlist', 'app.domain', 'app.gift_card_type', 'app.gc_design');

	function startTest() {
		$this->GiftCards =& new TestGiftCardsController();
		$this->GiftCards->constructClasses();
	}

	function endTest() {
		unset($this->GiftCards);
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