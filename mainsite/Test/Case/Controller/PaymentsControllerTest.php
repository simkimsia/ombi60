<?php
/* Payments Test cases generated on: 2010-04-17 12:04:50 : 1271508950*/
App::import('Controller', 'Payments');

class TestPaymentsController extends PaymentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PaymentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.payment');

	function startTest() {
		$this->Payments =& new TestPaymentsController();
		$this->Payments->constructClasses();
	}

	function endTest() {
		unset($this->Payments);
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