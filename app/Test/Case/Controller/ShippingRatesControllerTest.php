<?php
/* ShippingRates Test cases generated on: 2010-09-08 08:09:35 : 1283927375*/
App::import('Controller', 'ShippingRates');

class TestShippingRatesController extends ShippingRatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ShippingRatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.shipping_rate', 'app.country', 'app.price_based_rate', 'app.weight_based_rate');

	function startTest() {
		$this->ShippingRates =& new TestShippingRatesController();
		$this->ShippingRates->constructClasses();
	}

	function endTest() {
		unset($this->ShippingRates);
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