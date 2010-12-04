<?php
/* SVN FILE: $Id: category.test.php 126 2009-07-02 07:21:52Z miha@nahtigal.com $ */
/**
 * Short description for category.test.php
 *
 * Long description for category.test.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2009, Miha Nahtigal
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2009, Miha Nahtigal
 * @link          http://www.nahtigal.com/
 * @package       lil_blogs
 * @subpackage    lil_blogs.tests.cases.models
 * @since         v 1.0
 * @version       $Revision: 126 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-07-02 09:21:52 +0200 (čet, 02 jul 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
App::import('Model', 'LilBlogs.Category');
require dirname(dirname(__FILE__)).DS.'test.blogs.php';
/**
 * CategoryTestCase class
 *
 * @uses          CakeTestCase
 * @package       lil_blogs
 * @subpackage    lil_blogs.tests.cases.models
 */
class CategoryTestCase extends CakeTestCase {
/**
 * Category property
 *
 * @var object
 * @access public
 */
	var $Category = null;
/**
 * fixtures property
 *
 * @var array
 * @access public
 */
	var $fixtures = array(
		'plugin.lil_blogs.category', 'plugin.lil_blogs.author', 'plugin.lil_blogs.blog',
		'plugin.lil_blogs.authors_blog', 'plugin.lil_blogs.post', 'plugin.lil_blogs.comment',
		'plugin.lil_blogs.categories_post'
	);
/**
 * start method
 *
 * @access public
 * @return void
 */
	function start() {
		parent::start();
		$this->Category =& ClassRegistry::init('Category');
	}
/**
 * testCategoryInstance method
 *
 * @access public
 * @return void
 */
	function testCategoryInstance() {
		$this->assertTrue(is_a($this->Category, 'Category'));
	}
/**
 * testCategoryFind method
 *
 * @access public
 * @return void
 */
	function testCategoryFind() {
		$results = $this->Category->recursive = -1;
		$results = $this->Category->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Category' => array(
			'id'  => 1,
			'blog_id'  => 1,
			'name'  => 'Programming',
			'created'  => '2008-01-23 12:34:56',
			'modified'  => '2008-03-21 12:34:56'
		));
		$this->assertEqual($results, $expected);
	}
}
?>
