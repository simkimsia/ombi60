<?php
/* Blog Test cases generated on: 2011-09-22 09:42:11 : 1316684531*/
App::uses('Blog', 'Model');

/**
 * Blog Test Case
 *
 */
class BlogTestCase extends CakeTestCase {
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

		$this->Blog = ClassRegistry::init('Blog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Blog);
		ClassRegistry::flush();

		parent::tearDown();
	}

/**
 * testGetTemplateVariable method
 *
 * @return void
 */
	public function testGetTemplateVariable() {

	}

}
