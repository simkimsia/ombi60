<?php
/* SVN FILE: $Id: comments_controller.test.php 117 2009-06-23 13:16:48Z miha@nahtigal.com $ */
/**
 * Short description for comments_controller.test.php
 *
 * Long description for comments_controller.test.php
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
 * @version       $Revision: 117 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-06-23 15:16:48 +0200 (tor, 23 jun 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
App::import('Model', array('LilBlogs.Comment'));
require dirname(dirname(__FILE__)).DS.'test.blogs.php';
/**
 * CommentsControllerTest class
 *
 * @uses          AppTestCase
 * @package       lil_blogs
 * @subpackage    lil_blogs.tests.cases.controllers
 */
class CommentsControllerTest extends AppTestCase {
/**
 * fixtures property
 *
 * @var array
 * @access public
 */
	var $fixtures = array(
		'plugin.lil_blogs.author', 'plugin.lil_blogs.authors_blog',
		'plugin.lil_blogs.blog', 'plugin.lil_blogs.post', 'plugin.lil_blogs.comment',
		'plugin.lil_blogs.category', 'plugin.lil_blogs.categories_post',
		'plugin.lil_blogs.nb_category', 'plugin.lil_blogs.nb_wordfreq', 'plugin.lil_blogs.nb_reference'
	);
/**
 * testAdminIndex method
 *
 * @access public
 * @return void
 */
	function testAdminIndex() {
		$result = $this->testAction('/admin/lil_blogs/comments/index/1', array('return' => 'vars'));
		if ($this->assertIsA($result, 'array')) {
		    $result = Set::extract($result, 'comments.{n}.Comment.id');
			$this->assertEqual($result, array(2, 1));
		}
	}
/**
 * testAdminCategorize method
 *
 * @access public
 * @return void
 */
	function testAdminCategorize() {
		$this->Comment =& ClassRegistry::init('Comment'); $this->Comment->recursive = -1;
		$this->Comment->cacheQueries = false;
		
		$pre_status = $this->Comment->field('status', array('Comment.id' => 1));
		$this->assertEqual($pre_status, 1);
		
		$result = $this->testAction('/admin/lil_blogs/comments/categorize/1/2', array('return' => 'vars'));
		$this->assertRedirect();
		
		$post_status = $this->Comment->field('status', array('Comment.id' => 1));
		$this->assertEqual($post_status, 2);
	}
} 
?>
