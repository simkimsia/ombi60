<?php
/* PaymentModule Test cases generated on: 2010-06-08 08:06:07 : 1275979567*/
App::import('Model', 'PaymentModule');

class PaymentModuleTestCase extends CakeTestCase {
	var $fixtures = array('app.payment_module');

	function startTest() {
		$this->PaymentModule =& ClassRegistry::init('PaymentModule');
	}

	function endTest() {
		unset($this->PaymentModule);
		ClassRegistry::flush();
	}

}
?>