<?php
/* SVN FILE: $Id: comment_fixture.php 126 2009-07-02 07:21:52Z miha@nahtigal.com $ */
/**
 * Short description for comment_fixture.php
 *
 * Long description for comment_fixture.php
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
 * @subpackage    lil_blogs.tests.fixtures
 * @since         v 1.0
 * @version       $Revision: 126 $
 * @modifiedby    $LastChangedBy: miha@nahtigal.com $
 * @lastmodified  $Date: 2009-07-02 09:21:52 +0200 (čet, 02 jul 2009) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * CommentFixture class
 *
 * @uses          CakeTestFixture
 * @package       lil_blogs
 * @subpackage    lil_blogs.tests.fixtures
 */
class CommentFixture extends CakeTestFixture {
/**
 * name property
 *
 * @var string
 * @access public
 */
	var $name = 'Comment';
/**
 * fields property
 *
 * @var array
 * @access public
 */
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'post_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10),
			'body' => array('type'=>'text', 'null' => true, 'default' => NULL),
			'author' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
			'url' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 255),
			'email' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 255),
			'ip' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 15),
			'status' => array('type'=>'integer', 'null' => true, 'default' => '1', 'length' => 4),
			'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
			'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
/**
 * records property
 *
 * @var array
 * @access public
 */
	var $records = array(
		array(
			'id'  => 1,
			'post_id'  => 1,
			'body'  => 'Here comes my first comment: Hello World.',
			'author' => 'Arthur C. Clarke',
			'url' => 'http://www.arthur-clarke.com/',
			'email' => 'arthur@clarke.com',
			'ip' => '213.143.80.52',
			'status' => 1,
			'created'  => '2008-01-23 12:34:56',
			'modified'  => '2008-03-21 12:34:56'
		),
		array(
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
		),
	);
}
?>
