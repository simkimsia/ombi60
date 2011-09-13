<?php
/* PriceBasedRate Test cases generated on: 2010-09-08 08:09:43 : 1283927323*/
App::import('Model', 'PriceBasedRate');

class PriceBasedRateTestCase extends CakeTestCase {
	var $fixtures = array('app.price_based_rate', 'app.shipping_rate', 'app.country', 'app.weight_based_rate');

	function startTest() {
		$this->PriceBasedRate =& ClassRegistry::init('PriceBasedRate');
	}

	function endTest() {
		unset($this->PriceBasedRate);
		ClassRegistry::flush();
	}

}
?>