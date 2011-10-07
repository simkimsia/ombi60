<?php
/* Courses Test cases generated on: 2011-09-01 13:38:15 : 1314884295*/
App::uses('DomainsController', 'Controller');

/**
 * CoursesController Test Case
 *
 */
class DomainsControllerTestCase extends ControllerTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array(
		'app.merchant', 'app.saved_theme', 'app.user', 
		'app.shop_setting', 'app.shop', 'app.domain', 
		'app.post', 'app.comment', 'app.link', 
		'app.link_list', 'app.product', 'app.webpage'
	);

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
		$this->controller = $this->generate('Domains', array(
			'methods' => array('forceSSL'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		$this->testAction('/admin/domains/index', array('return' => 'contents'));
		$this->assertRegexp('#<h2 class="text_center">Domains</h2>#', $this->contents);
		$this->assertRegexp('#<td>http://localhost&nbsp;</td>#', $this->contents);
	}

	/**
	 * testView method
	 *
	 * @return void
	 */
	public function testAdminView() {
		$this->controller = $this->generate('Domains', array(
			'methods' => array('forceSSL'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		$this->testAction('/admin/domains/view/2', array('return' => 'contents'));
		$expected = array('tag' => 'h2', 'content' => 'Domain');
		$this->assertTag($expected, $this->contents);
		$expected = array(
			'tag' => 'dl',
			'child' => array(
				'tag' => 'dd',
				'content' => 'http://localhost'
			),
			'children' => array(
				'count' => 8
			)
		);
		$this->assertTag($expected, $this->contents);
	}

	function testAdminAdd() {
		$this->controller = $this->generate('Domains', array(
			'methods' => array('forceSSL', 'sendJson'), 
			'components' => array('Auth' => array('user'), 'Security')
		));
		$fixture = new DomainFixture();	
		$this->controller->request->data['Domain'] = $fixture->records[1];
		unset($this->controller->request->data['Domain']['id']);
		$this->controller->request->data['Domain']['domain'] = 'http://localhost2';
		$this->assertFlash($this->controller, 'The domain has been saved');
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$this->testAction('/admin/domains/add', array('data' => $this->controller->request->data, 'method' => 'POST'));
		debug($this->controller->Domain->getLastInsertId());
		die();
	 }

	function testAdminEdit() {
		$this->controller = $this->generate('Domains', array(
					'methods' => array('forceSSL'), 
					'components' => array('Auth' => array('user'), 'Security')
		));
		$fixture = new DomainFixture();
		$this->controller->request->data['Domain'] = $fixture->records[1];
		$this->controller->request->data['Domain']['domain'] = "Test2";
		$this->assertFlash($this->controller, 'The domain has been saved');
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$this->testAction('/admin/domains/edit/2', array('data' => $this->controller->request->data, 'method' => 'POST'));
	}

	function testAdminDelete() {
		$this->controller = $this->generate('Domains', array(
					'methods' => array('forceSSL'), 
					'components' => array('Auth' => array('user'), 'Security')
		));
		$this->assertFlash($this->controller, 'Domain deleted');
		$this->testAction('/admin/domains/delete/2');
	}

}
?>
