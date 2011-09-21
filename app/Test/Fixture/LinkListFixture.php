<?php
/* LinkList Fixture generated on: 2011-09-21 17:21:13 : 1316625673 */

/**
 * LinkListFixture
 *
 */
class LinkListFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'deletable' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'link_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 3, 'collate' => NULL, 'comment' => ''),
		'handle' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 150, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
			'shop_id' => '2',
			'name' => 'Main Menu',
			'deletable' => 0,
			'link_count' => '5',
			'handle' => 'main-menu'
		),
		array(
			'id' => '2',
			'shop_id' => '2',
			'name' => 'Footer Menu',
			'deletable' => 0,
			'link_count' => '4',
			'handle' => 'footer-menu'
		),
	);
}
