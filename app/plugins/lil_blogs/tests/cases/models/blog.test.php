<?php
/* SVN FILE: $Id: blog.test.php 126 2009-07-02 07:21:52Z miha@nahtigal.com $ */
/**
 * Short description for blog.test.php
 *
 * Long description for blog.test.php
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
App::import('Model', 'LilBlogs.Blog');
require dirname(dirname(__FILE__)).DS.'test.blogs.php';
/**
 * AuthorTestCase class
 *
 * @uses          CakeTestCase
 * @package       lil_blogs
 * @subpackage    lil_blogs.tests.cases.models
 */
class BlogTestCase extends CakeTestCase {
/**
 * Blog property
 *
 * @var object
 * @access public
 */
	var $Blog = null;
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
		$this->Blog =& ClassRegistry::init('Blog');
	}
/**
 * testBlogInstance method
 *
 * @access public
 * @return void
 */
	function testBlogInstance() {
		$this->assertTrue(is_a($this->Blog, 'Blog'));
	}
/**
 * testBlogFind method
 *
 * @access public
 * @return void
 */
	function testBlogFind() {
		$results = $this->Blog->recursive = -1;
		$results = $this->Blog->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Blog' => array(
			'id'  => 1,
			'name'  => 'My First Blog',
			'short_name' => 'first',
			'description' => 'This is my first blog.',
			'theme' => null,
			'created'  => '2008-01-23 12:34:56',
			'modified'  => '2008-03-21 12:34:56'
		));
		$this->assertEqual($results, $expected);
	}
}
?>
