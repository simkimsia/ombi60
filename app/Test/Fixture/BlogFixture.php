<?php
/* Blog Fixture generated on: 2011-09-21 16:58:06 : 1316624286 */

/**
 * BlogFixture
 *
 */
class BlogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'short_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 150, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'theme' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'visible_post_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'all_post_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
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
			'id' => '2',
			'title' => 'news',
			'short_name' => 'news',
			'description' => NULL,
			'theme' => NULL,
			'created' => '2011-09-16 17:56:03',
			'modified' => '2011-09-16 17:56:03',
			'shop_id' => NULL,
			'visible_post_count' => '0',
			'all_post_count' => '0'
		),
		array(
			'id' => '3',
			'title' => 'Test',
			'short_name' => 'test',
			'description' => NULL,
			'theme' => NULL,
			'created' => '2011-09-17 14:38:45',
			'modified' => '2011-09-17 14:38:45',
			'shop_id' => '2',
			'visible_post_count' => '2',
			'all_post_count' => '2'
		),
	);
}
