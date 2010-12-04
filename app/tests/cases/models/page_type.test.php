<?php
/* PageType Test cases generated on: 2010-04-17 12:04:01 : 1271507881*/
App::import('Model', 'PageType');

class PageTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.webpage_type');

	function startTest() {
		$this->PageType =& ClassRegistry::init('PageType');
	}

	function endTest() {
		unset($this->PageType);
		ClassRegistry::flush();
	}

}
?>