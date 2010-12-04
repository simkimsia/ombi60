<?php
/* PageTypes Test cases generated on: 2010-04-17 12:04:53 : 1271508893*/
App::import('Controller', 'PageTypes');

class TestPageTypesController extends PageTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PageTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.page_type');

	function startTest() {
		$this->PageTypes =& new TestPageTypesController();
		$this->PageTypes->constructClasses();
	}

	function endTest() {
		unset($this->PageTypes);
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