<?php
/* Blog Test cases generated on: 2010-09-02 04:09:39 : 1283395059*/
App::import('Model', 'Blog');

class BlogTestCase extends CakeTestCase {
	var $fixtures = array('app.blog', 'app.post');

	function startTest() {
		$this->Blog =& ClassRegistry::init('Blog');
	}

	function endTest() {
		unset($this->Blog);
		ClassRegistry::flush();
	}

}
?>