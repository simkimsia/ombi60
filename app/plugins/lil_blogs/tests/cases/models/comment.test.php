<?php
/* SVN FILE: $Id: comment.test.php 126 2009-07-02 07:21:52Z miha@nahtigal.com $ */
/**
 * Short description for comment.test.php
 *
 * Long description for comment.test.php
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
App::import('Model', 'LilBlogs.Comment');
require dirname(dirname(__FILE__)).DS.'test.blogs.php';
/**
 * CommentTestCase class
 *
 * @uses          CakeTestCase
 * @package       lil_blogs
 * @subpackage    lil_blogs.tests.cases.models
 */
class CommentTestCase extends CakeTestCase {
/**
 * Comment property
 *
 * @var object
 * @access public
 */
	var $Comment = null;
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
 * start method
 *
 * @access public
 * @return void
 */
	function start() {
		parent::start();
		$this->Comment =& ClassRegistry::init('Comment');
	}
/**
 * testCommentInstance method
 *
 * @access public
 * @return void
 */
	function testCommentInstance() {
		$this->assertTrue(is_a($this->Comment, 'Comment'));
	}
/**
 * testCommentFind method
 *
 * @access public
 * @return void
 */
	function testCommentFind() {
		$results = $this->Comment->recursive = -1;
		$results = $this->Comment->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Comment' => array(
			'id'  => 2,
			'post_id'  => 1,
			'body'  => 'Go go Truman Show.',
			'author' => 'Jane Truman',
			'url' => NULL,
			'email' => NULL,
			'ip' => '80.77.112.99',
			'status' => 2,
			'created'  => '2008-04-05 11:22:33',
			'modified'  => '2008-11-22 11:22:33'
		));
		$this->assertEqual($results, $expected);
	}
}
?>
