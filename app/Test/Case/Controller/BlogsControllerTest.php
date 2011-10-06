<?php
/* Courses Test cases generated on: 2011-09-01 13:38:15 : 1314884295*/
App::uses('BlogsController', 'Controller');

/**
 * CoursesController Test Case
 *
 */
class BlogsControllerTestCase extends ControllerTestCase {
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

	/**
	 * testIndex method
	 *
	 * @return void
	 */
	public function testAdminIndex() {
		$this->controller = $this->generate('Blogs', array(
			'methods' => array('forceSSL'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		$this->testAction('/admin/blogs/index', array('return' => 'contents'));
		$this->assertRegexp('#<h2>Blogs</h2>#', $this->contents);
		$this->assertRegexp('#<td>Test&nbsp;</td>#', $this->contents);
		$this->assertRegexp('#<td>test&nbsp;</td>#', $this->contents);
	}

	/**
	 * testView method
	 *
	 * @return void
	 */
	public function testAdminView() {
		$this->controller = $this->generate('Blogs', array(
			'methods' => array('forceSSL'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		$this->testAction('/admin/blogs/view/3', array('return' => 'contents'));
		$expected = array('tag' => 'h2', 'content' => 'Test');
		$this->assertTag($expected, $this->contents);
	}

	function testAdminAdd() {
		$this->controller = $this->generate('Blogs', array(
			'methods' => array('forceSSL'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		$fixture = new BlogFixture();	
		$this->controller->request->data['Blog'] = $fixture->records[1];
		unset($this->controller->request->data['Blog']['id']);
		$this->assertFlash($this->controller, 'The blog has been saved');
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$this->testAction('/admin/blogs/add', array('data' => $this->controller->request->data, 'method' => 'POST'));
	}

	function testAdminEdit() {
		$this->controller = $this->generate('Blogs', array(
					'methods' => array('forceSSL'), 
					'components' => array('Auth' => array('user'), 'Security')
		));
		$fixture = new BlogFixture();
		$this->controller->request->data['Blog'] = $fixture->records[1];
		$this->controller->request->data['Blog']['name'] = "Test2";
		$this->assertFlash($this->controller, 'The blog has been saved');
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$this->testAction('/admin/blogs/edit/3', array('data' => $this->controller->request->data, 'method' => 'POST'));
	}

	function testAdminDelete() {
		$this->controller = $this->generate('Blogs', array(
					'methods' => array('forceSSL'), 
					'components' => array('Auth' => array('user'), 'Security')
		));
		$this->assertFlash($this->controller, 'Blog deleted');
		$this->testAction('/admin/blogs/delete/3');
	}

}
?>