<?php
/* Country Test cases generated on: 2010-09-08 08:09:41 : 1283927081*/
App::import('Model', 'Country');

class CountryTestCase extends CakeTestCase {
	var $fixtures = array('app.country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate');

	function startTest() {
		$this->Country =& ClassRegistry::init('Country');
	}

	function endTest() {
		unset($this->Country);
		ClassRegistry::flush();
	}

}
?>