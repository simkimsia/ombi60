<?php
/* Post Fixture generated on: 2011-09-28 10:38:55 : 1317206335 */

/**
 * PostFixture
 *
 */
class PostFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'blog_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'author_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'visible' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'slug' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 150, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'content' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'no_comments' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'collate' => NULL, 'comment' => ''),
		'allow_comments' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'allow_pingback' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'published' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'blog_handle' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 150, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'blog_id' => '1',
			'author_id' => '1',
			'visible' => 1,
			'title' => 'Open for business!',
			'slug' => 'open-for-business',
			'content' => 'We are OPEN for business!!',
			'no_comments' => '0',
			'allow_comments' => 1,
			'allow_pingback' => 1,
			'created' => '2011-07-08 11:54:46',
			'modified' => '2011-07-08 11:54:46',
			'published' => NULL,
			'blog_handle' => 'news'
		),
	);
}
