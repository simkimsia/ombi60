<?php
/* SVN FILE: $Id: blogs_controller.test.php 126 2009-07-02 07:21:52Z miha@nahtigal.com $ */
/**
 * Short description for blogs_controller.test.php
 *
 * Long description for blogs_controller.test.php
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
 * @subpackage    lil_blogs.tests.cases.controllers
 * @since         v 1.0
 * @version       $Revision: 126 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-07-02 09:21:52 +0200 (čet, 02 jul 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
App::import('Model', array('LilBlogs.Blog', 'LilBlogs.Category', 'LilBlogs.Author'));
require dirname(dirname(__FILE__)).DS.'test.blogs.php';
/**
 * BlogsControllerTest class
 *
 * @uses          AppTestCase
 * @package       lil_blogs
 * @subpackage    lil_blogs.tests.cases.controllers
 */
class BlogsControllerTest extends AppTestCase {
/**
 * fixtures property
 *
 * @var array
 * @access public
 */
	var $fixtures = array(
		'plugin.lil_blogs.category', 'plugin.lil_blogs.author', 'plugin.lil_blogs.authors_blog',
		'plugin.lil_blogs.blog', 'plugin.lil_blogs.post', 'plugin.lil_blogs.comment',
		'plugin.lil_blogs.categories_post'
	);
/**
 * testIndex method
 *
 * @access public
 * @return void
 */
	function testIndex() {
		$result = $this->testAction('/lil_blogs', array('return' =>'vars'));
		if ($this->assertIsA($result, 'array')) {
			$this->assertEqual(Set::extract($result, 'blogs.{n}.Blog.id'), array(1, 2));
		}
	}
/**
 * testView method
 *
 * @access public
 * @return void
 */
	function testView() {
		$result = $this->testAction('/lil_blogs/blogs/view/first', array('return' =>'vars'));
		$this->assertRedirect('/lil_blogs/first');
		
		$result = $this->testAction('/lil_blogs/blogs/view/second', array('return' =>'vars'));
		$this->assertRedirect('/lil_blogs/second');
	}
/**
 * testAdminIndex method
 *
 * @access public
 * @return void
 */
	function testAdminIndex() {
		$result = $this->testAction('/admin/lil_blogs/blogs/index', array('return' =>'vars'));
		if ($this->assertIsA($result, 'array')) {
			$this->assertEqual(Set::extract($result, 'blogs.{n}.Blog.id'), array(1,2));
		}
	}
/**
 * testAdminAdd method
 *
 * @access public
 * @return void
 */
	function testAdminAdd() {
		$addBlogName = 'Test Suite Blog';
		
		// check valid data
		$result = $this->testAction('/admin/lil_blogs/blogs/add', array('data'=>array('Blog'=>array('name'=>$addBlogName, 'short_name'=>'test-suite-blog', 'description'=>'Test suite blog entry.')), 'return' =>'vars'));
		$this->assertRedirect();
		
		// check if newly added category exists
		$this->Blog =& ClassRegistry::init('Blog'); $this->Blog->recursive = -1;
		$result_data = $this->Blog->findByName($addBlogName);
		$this->assertEqual(@$result_data['Blog']['name'], $addBlogName);
		
	}
/**
 * testAdminEdit method
 *
 * @access public
 * @return void
 */
	function testAdminEdit() {
		$addBlogName = 'Test Suite Blog';
		
		$result = $this->testAction('/admin/lil_blogs/blogs/edit/', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/blogs/edit/112233', array('return' =>'vars'));
		$this->assert404();
		
		// check valid data
		$result = $this->testAction('/admin/lil_blogs/blogs/edit', array('data'=>array('Blog'=>array('id'=>1, 'name'=>$addBlogName, 'short_name'=>'test-suite-blog', 'description'=>'Test suite blog entry.')), 'return' =>'vars'));
		$this->assertRedirect();
		
		// check if newly added category exists
		$this->Blog =& ClassRegistry::init('Blog'); $this->Blog->recursive = -1;
		$result_data = $this->Blog->findById(1);
		$this->assertEqual(@$result_data['Blog']['name'], $addBlogName);
		
	}
/**
 * testAdminDelete method
 *
 * @access public
 * @return void
 */
	function testAdminDelete() {
		$result = $this->testAction('/admin/lil_blogs/blogs/delete/', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/blogs/delete/112233', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/blogs/delete/1', array('return' =>'vars'));
		$this->assertRedirect();
	}
} 
?>
