<?php
/* WeightBasedRate Test cases generated on: 2010-09-08 08:09:06 : 1283927346*/
App::import('Model', 'WeightBasedRate');

class WeightBasedRateTestCase extends CakeTestCase {
	var $fixtures = array('app.weight_based_rate', 'app.shipping_rate', 'app.country', 'app.price_based_rate');

	function startTest() {
		$this->WeightBasedRate =& ClassRegistry::init('WeightBasedRate');
	}

	function endTest() {
		unset($this->WeightBasedRate);
		ClassRegistry::flush();
	}

}
?>