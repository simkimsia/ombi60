<?php
/* SVN FILE: $Id: categories_controller.test.php 126 2009-07-02 07:21:52Z miha@nahtigal.com $ */
/**
 * Short description for categories_controller.test.php
 *
 * Long description for categories_controller.test.php
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
App::import('Model', array('LilBlogs.Category', 'LilBlogs.Blog', 'LilBlogs.Post'));
require dirname(dirname(__FILE__)).DS.'test.blogs.php';
/**
 * CategoriesControllerTest class
 *
 * @uses          AppTestCase
 * @package       lil_blogs
 * @subpackage    lil_blogs.tests.cases.controllers
 */
class CategoriesControllerTest extends AppTestCase {
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
 * testAdminIndex method
 *
 * @access public
 * @return void
 */
	function testAdminIndex() {
		$result = $this->testAction('/admin/lil_blogs/categories/index', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/categories/index/112233', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/categories/index/1', array('return' =>'vars'));
		if ($this->assertIsA($result, 'array')) {
			$this->assertEqual(Set::extract($result, 'data.{n}.Category.id'), array(1, 2));
		}
	}
/**
 * testAdminAdd method
 *
 * @access public
 * @return void
 */
	function testAdminAdd() {
		
		$addCategoryName = 'Test Suite Category';
		
		$result = $this->testAction('/admin/lil_blogs/categories/add/', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/categories/add/112233', array('return' =>'vars'));
		$this->assert404();
		
		// check valid data
		$result = $this->testAction('/admin/lil_blogs/categories/add', array('data'=>array('Category'=>array('blog_id'=>1, 'name'=>$addCategoryName)), 'return' =>'vars'));
		$this->assertRedirect();
		
		// check if newly added category exists
		$this->Category =& ClassRegistry::init('Category'); $this->Category->recursive = -1;
		$result_data = $this->Category->findByName($addCategoryName);
		$this->assertEqual(@$result_data['Category']['name'], $addCategoryName);
	}
/**
 * testAdminEdit method
 *
 * @access public
 * @return void
 */
	function testAdminEdit() {
		$editedCategoryName = 'Test Suite Category';
		
		$result = $this->testAction('/admin/lil_blogs/categories/edit/', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/categories/edit/112233', array('return' =>'vars'));
		$this->assert404();
		
		// check valid data
		$result = $this->testAction('/admin/lil_blogs/categories/edit', array('data'=>array('Category'=>array('id'=>1, 'blog_id'=>1, 'name'=>$editedCategoryName)), 'return' =>'vars'));
		$this->assertRedirect();
		
		// check if newly added category exists
		$this->Category =& ClassRegistry::init('Category'); $this->Category->recursive = -1;
		$result_data = $this->Category->findById(1);
		$this->assertEqual(@$result_data['Category']['name'], $editedCategoryName);
	}
/**
 * testAdminDelete method
 *
 * @access public
 * @return void
 */
	function testAdminDelete() {
		$result = $this->testAction('/admin/lil_blogs/categories/delete/', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/categories/delete/112233', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/categories/delete/1', array('return' =>'vars'));
		$this->assertRedirect();
	}
} 
?>
