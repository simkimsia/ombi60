<?php
/* Courses Test cases generated on: 2011-09-01 13:38:15 : 1314884295*/
App::uses('LinkListsController', 'Controller');

/**
 * CoursesController Test Case
 *
 */
class LinkListsControllerTestCase extends ControllerTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array('app.blog', 'app.saved_theme', 'app.user', 'app.shop_setting', 'app.shop', 'app.domain', 'app.post', 'app.comment', 'app.link', 'app.link_list', 'app.product', 'app.webpage');

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();
		$this->controller = $this->generate('LinkLists', array(
					'methods' => array('forceSSL'), 
					'components' => array('Auth' => array('user'))
		));
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		ClassRegistry::flush();

		parent::tearDown();
	}


	public function testAdminEdit() {

		$fixture = new LinkListFixture();
		$this->controller->request->data['LinkList'] = $fixture->records[1];
		$this->controller->request->data['LinkList']['name'] = "Main Menu";
		$this->assertFlash($this->controller, 'The linklist has been saved');
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$this->testAction('/admin/links/edit/3', array('data' => $this->controller->request->data, 'method' => 'POST'));
	}
}
?>