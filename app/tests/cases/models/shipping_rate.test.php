<?php
/* ShippingRate Test cases generated on: 2010-09-08 08:09:17 : 1283927297*/
App::import('Model', 'ShippingRate');

class ShippingRateTestCase extends CakeTestCase {
	var $fixtures = array('app.shipping_rate', 'app.country', 'app.price_based_rate', 'app.weight_based_rate');

	function startTest() {
		$this->ShippingRate =& ClassRegistry::init('ShippingRate');
	}

	function endTest() {
		unset($this->ShippingRate);
		ClassRegistry::flush();
	}

}
?>