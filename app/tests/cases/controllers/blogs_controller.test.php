<?php
/* Blogs Test cases generated on: 2010-09-02 04:09:20 : 1283395100*/
App::import('Controller', 'Blogs');

class TestBlogsController extends BlogsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class BlogsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.blog', 'app.post');

	function startTest() {
		$this->Blogs =& new TestBlogsController();
		$this->Blogs->constructClasses();
	}

	function endTest() {
		unset($this->Blogs);
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

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>