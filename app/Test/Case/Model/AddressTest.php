<?php
/* Address Test cases generated on: 2010-04-17 12:04:15 : 1271507775*/
App::import('Model', 'Address');

class AddressTestCase extends CakeTestCase {
	var $fixtures = array('app.address');

	function startTest() {
		$this->Address =& ClassRegistry::init('Address');
	}

	function endTest() {
		unset($this->Address);
		ClassRegistry::flush();
	}

}
?>