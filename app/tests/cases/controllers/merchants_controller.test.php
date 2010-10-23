<?php
/* Merchants Test cases generated on: 2010-04-17 12:04:13 : 1271508253*/
App::import('Controller', 'Merchants');

class TestMerchantsController extends MerchantsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
	
	function render($action = null, $layout = null, $file = null) {
		$this->renderedAction = $action;
	}

	function _stop($status = 0) {
		$this->stopped = $status;
	}
	
}

class MerchantsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.merchant', 'app.shop', 'app.customer', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.webpage', 'app.page_type', 'app.user', 'app.group', );

	function startTest() {
		$this->Merchants =& new TestMerchantsController();
		$this->Merchants->constructClasses();
		$this->Merchants->Component->initialize($this->Merchants);
	}

	function endTest() {
		unset($this->Merchants);
		ClassRegistry::flush();
	}

	function testRegister() {

	}

	function testLogin() {

	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testDelete() {

	}
	
	

}
?>