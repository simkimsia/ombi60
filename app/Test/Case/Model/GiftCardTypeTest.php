<?php
/* GiftCardType Test cases generated on: 2010-09-04 14:09:46 : 1283604826*/
App::import('Model', 'GiftCardType');

class GiftCardTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.gift_card_type', 'app.gift_card');

	function startTest() {
		$this->GiftCardType =& ClassRegistry::init('GiftCardType');
	}

	function endTest() {
		unset($this->GiftCardType);
		ClassRegistry::flush();
	}

}
?>