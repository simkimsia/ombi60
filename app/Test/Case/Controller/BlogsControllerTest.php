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
	public $fixtures = array('app.blog', 'app.saved_theme', 'app.user', 'app.shop_setting', 'app.shop', 'app.domain');

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
			'components' => array('Auth' => array('user'))
		));
		$this->testAction('/admin/blogs/index', array('return' => 'contents'));
		debug($this->contents);
		die();
		$this->assertRegexp('#<h2>Courses</h2>#', $this->contents);
		$this->assertRegexp('#<td>CAKE-101&nbsp;</td>#', $this->contents);
		$this->assertRegexp('#<td>CAKE-201&nbsp;</td>#', $this->contents);
	}

	/**
	 * testView method
	 *
	 * @return void
	 */
	public function testAdminView() {
		$this->controller = $this->generate('Blogs', array(
			'components' => array('Auth' => array('user'))
		));
		$this->testAction('/courses/view/course-1', array('return' => 'contents'));
		$expected = array('tag' => 'h2', 'content' => 'Course');
		$this->assertTag($expected, $this->contents);

		$expected = array(
			'tag' => 'dl',
			'child' => array(
				'tag' => 'dd',
				'content' => 'CAKE-101'
			),
			'children' => array(
				'count' => 10
			)
		);
		$this->assertTag($expected, $this->contents);

		$expected = array(
			'tag' => 'h3',
			'content' => 'Students',
			'ancestor' => array('tag' => 'div')
		);
		$this->assertTag($expected, $this->contents);

		$expected = array(
			'tag' => 'tr',
			'ancestor' => array(
				'tag' => 'table',
				'ancestor' => array('tag' => 'div', 'class' => 'related')
			),
			'child' => array(
				'tag' => 'td',
				'content' => 'Chuck Norris'
			)
		);
		$this->assertTag($expected, $this->contents);
	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>