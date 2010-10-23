<?php
/* SVN FILE: $Id: authors_controller.test.php 126 2009-07-02 07:21:52Z miha@nahtigal.com $ */
/**
 * Short description for authors_controller.test.php
 *
 * Long description for authors_controller.test.php
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
App::import('Model', array('LilBlogs.Author'));
require dirname(dirname(__FILE__)).DS.'test.blogs.php';
/**
 * AuthorsControllerTest class
 *
 * @uses          AppTestCase
 * @package       lil_blogs
 * @subpackage    lil_blogs.tests.cases.controllers
 */
class AuthorsControllerTest extends AppTestCase {
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
		$result = $this->testAction('/admin/lil_blogs/authors/index', array('return' => 'vars'));
		if ($this->assertIsA($result, 'array')) {
			$this->assertEqual(Set::extract($result, 'authors.{n}.Author.id'), array(1, 2));
		}
	}
/**
 * testAdminAdd method
 *
 * @access public
 * @return void
 */
	function testAdminAdd() {
		$addAuthorName = 'Test Suite Author';
		
		// check valid data
		$result = $this->testAction('/admin/lil_blogs/authors/add', array(
			'data' => array(
				'Author' => array('name'=>$addAuthorName)
			),
			'return' => 'vars'
		));
		$this->assertRedirect();
		
		// check if newly added category exists
		$this->Author =& ClassRegistry::init('Author'); $this->Author->recursive = -1;
		$result_data = $this->Author->findByName($addAuthorName);
		$this->assertEqual(@$result_data['Author']['name'], $addAuthorName);
	}
/**
 * testAdminEdit method
 *
 * @access public
 * @return void
 */
	function testAdminEdit() {
		$editedAuthorName = 'Test Suite Author';
		
		$result = $this->testAction('/admin/lil_blogs/authors/edit/', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/authors/edit/112233', array('return' =>'vars'));
		$this->assert404();
		
		// check valid data
		$result = $this->testAction('/admin/lil_blogs/authors/edit', array(
			'data'=>array('Author'=>array('id'=>1, 'name'=>$editedAuthorName)),
			'return' =>'vars'
		));
		$this->assertRedirect();
		
		// check if newly added category exists
		$this->Author =& ClassRegistry::init('Author'); $this->Author->recursive = -1;
		$result_data = $this->Author->findById(1);
		$this->assertEqual(@$result_data['Author']['name'], $editedAuthorName);
	}
/**
 * testAdminDelete method
 *
 * @access public
 * @return void
 */
	function testAdminDelete() {
		$result = $this->testAction('/admin/lil_blogs/authors/delete/', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/authors/delete/112233', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/authors/delete/1', array('return' =>'vars'));
		$this->assertRedirect();
	}
} 
?>
