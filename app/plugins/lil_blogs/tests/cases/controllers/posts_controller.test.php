<?php
/* SVN FILE: $Id: posts_controller.test.php 142 2009-08-30 17:35:46Z miha@nahtigal.com $ */
/**
 * Short description for posts_controller.test.php
 *
 * Long description for posts_controller.test.php
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
 * @version       $Revision: 142 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-08-30 19:35:46 +0200 (ned, 30 avg 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
App::import('Model', array('LilBlogs.Post', 'LilBlogs.Author', 'LilBlogs.Category', 'LilBlogs.Blog', 'LilBlogs.Comment'));
require dirname(dirname(__FILE__)).DS.'test.blogs.php';
/**
 * PostsControllerTest class
 *
 * @uses          AppTestCase
 * @package       lil_blogs
 * @subpackage    lil_blogs.tests.cases.controllers
 */
class PostsControllerTest extends AppTestCase {
/**
 * fixtures property
 *
 * @var array
 * @access public
 */
	var $fixtures = array(
		'plugin.lil_blogs.category', 'plugin.lil_blogs.author', 'plugin.lil_blogs.authors_blog',
		'plugin.lil_blogs.blog', 'plugin.lil_blogs.post', 'plugin.lil_blogs.comment',
		'plugin.lil_blogs.nb_category', 'plugin.lil_blogs.nb_wordfreq',
		'plugin.lil_blogs.nb_reference', 'plugin.lil_blogs.categories_post'
	);
/**
 * testIndex method
 *
 * @access public
 * @return void
 */
	function testIndex() {
		$result = $this->testAction('/lil_blogs/notexistant', array('return' => 'vars'));
		$this->assert404();
		
		$result = $this->testAction('/lil_blogs/first', array('return' => 'vars'));
		if ($this->assertIsA($result, 'array')) {
			$this->assertEqual(Set::extract($result, 'recentposts.{n}.Post.id'), array(2, 1));
		}
	}
/**
 * testView method
 *
 * @access public
 * @return void
 */
	function testView() {
		$result = $this->testAction('/lil_blogs/posts/view/first/notexistant', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/lil_blogs/posts/view/first/my-first-post', array('return' =>'vars'));
		if ($this->assertIsA($result, 'array')) {
			$this->assertEqual($result['post']['Post']['id'], 1);
		}
	}
/**
 * testViewCommentAdd method
 *
 * @access public
 * @return void
 */
	function testViewCommentAdd() {
	    Configure::write('LilBlogsPlugin.emailDelivery', 'debug');
	    
	    $result = $this->testAction('/lil_blogs/posts/view/first/my-first-post', array(
			'return' =>'vars',
			'data' => array(
				'Comment' => array(
					'id'  => 2,
					'post_id'  => 1,
					'body'  => 'This is a short blog post. It\'s an answer to selected psot.',
					'author' => 'Jane Small',
					'url' => NULL,
					'email' => 'somemail@nowhere.com',
					'ip' => '80.77.112.99',
					'status' => 2,
					'created'  => '2008-04-05 11:22:33',
					'modified'  => '2008-11-22 11:22:33'
				)
			)
		));
		$this->assertRedirect();
		
		$Sess = new CakeSession();
		$mail = $Sess->read('Message');
		//print_r($mail);
	}
/**
 * testAdminIndex method
 *
 * @access public
 * @return void
 */
	function testAdminIndex() {
		$result = $this->testAction('/admin/lil_blogs/posts/index/', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/posts/index/112233', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/posts/index/1', array('return' =>'vars'));
		if ($this->assertIsA($result, 'array')) {
			$this->assertEqual(Set::extract($result, 'data.{n}.Post.id'), array(2, 1));
		}
	}
/**
 * testAdminAdd method
 *
 * @access public
 * @return void
 */
	function testAdminAdd() {
		$addPostName = 'Test Suite Post';
		
		$result = $this->testAction('/admin/lil_blogs/posts/add/', array('return' =>'vars'));
		$this->assert404();
		
		// check valid data
		$result = $this->testAction('/admin/lil_blogs/posts/add', array('data'=>array('Post'=>array(
			'blog_id' 			=> 1,
			'author_id' 		=> 1,
			'category_id' 		=> 1,
			'title'				=> $addPostName,
			'slug' 				=> 'test-suite-post',
			'body'				=> 'Test suite post entry.',
			'allow_comments'	=> 1,
			'allow_pingbacks'	=> 1,
			'status'			=> 0)
		), 'return' =>'vars'));
		$this->assertRedirect();
		
		// check if newly added category exists
		$this->Post =& ClassRegistry::init('Post'); $this->Post->recursive = -1;
		$result_data = $this->Post->findByTitle($addPostName);
		$this->assertEqual(@$result_data['Post']['title'], $addPostName);
		
	}
/**
 * testAdminEdit method
 *
 * @access public
 * @return void
 */
	function testAdminEdit() {
		$addPostName = 'Test Suite Post';
		
		$result = $this->testAction('/admin/lil_blogs/posts/edit/', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/posts/edit/112233', array('return' =>'vars'));
		$this->assert404();
		
		// check valid data
		$result = $this->testAction('/admin/lil_blogs/posts/edit', array('data'=>array('Post'=>array(
			'id'				=> 1,
			'blog_id' 			=> 1,
			'author_id' 		=> 1,
			'category_id' 		=> 1,
			'title'				=> $addPostName,
			'slug' 				=> 'test-suite-post',
			'body'				=> 'Test suite post entry.',
			'allow_comments'	=> 1,
			'allow_pingbacks'	=> 1,
			'status'			=> 0
		)), 'return' =>'vars'));
		$this->assertRedirect();
		
		// check if newly added category exists
		$this->Post =& ClassRegistry::init('Post'); $this->Post->recursive = -1;
		$result_data = $this->Post->findById(1);
		$this->assertEqual(@$result_data['Post']['title'], $addPostName);
		
	}
/**
 * testAdminDelete method
 *
 * @access public
 * @return void
 */
	function testAdminDelete() {
		$result = $this->testAction('/admin/lil_blogs/posts/delete/', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/posts/delete/112233', array('return' =>'vars'));
		$this->assert404();
		
		$result = $this->testAction('/admin/lil_blogs/posts/delete/1', array('return' =>'vars'));
		$this->assertRedirect();
	}
} 
?>
