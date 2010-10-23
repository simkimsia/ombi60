<?php
/* SVN FILE: $Id: author.test.php 142 2009-08-30 17:35:46Z miha@nahtigal.com $ */
/**
 * Short description for author.test.php
 *
 * Long description for author.test.php
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
 * @version       $Revision: 142 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-08-30 19:35:46 +0200 (ned, 30 avg 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
App::import('Model', 'LilBlogs.Author');
require dirname(dirname(__FILE__)).DS.'test.blogs.php';
/**
 * AuthorTestCase class
 *
 * @uses          CakeTestCase
 * @package       lil_blogs
 * @subpackage    lil_blogs.tests.cases.models
 */
class AuthorTestCase extends CakeTestCase {
/**
 * Author property
 *
 * @var object
 * @access public
 */
	var $Author = null;
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
		$this->Author =& ClassRegistry::init('Author');
	}
/**
 * testAuthorInstance method
 *
 * @access public
 * @return void
 */
	function testAuthorInstance() {
		$this->assertTrue(is_a($this->Author, 'Author'));
	}
/**
 * testAuthorFind method
 *
 * @access public
 * @return void
 */
	function testAuthorFind() {
		$results = $this->Author->recursive = -1;
		$results = $this->Author->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Author' => array(
			'id'  => 1,
			'admin' => 1,
			'name'  => 'John Doe',
			'email' => 'john@doe.com',
			'username' => 'johndoe',
			'passwd' => '',
			'created'  => '2008-01-23 12:34:56',
			'modified'  => '2008-03-21 12:34:56'
		));
		$this->assertEqual($results, $expected);
	}
}
?>
