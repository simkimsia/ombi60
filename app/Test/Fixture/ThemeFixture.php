<?php
/* Theme Fixture generated on: 2011-12-14 04:32:28 : 1323837148 */

/**
 * ThemeFixture
 *
 */
class ThemeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'author' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'available_for_all' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'folder_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'price' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '7,2', 'collate' => NULL, 'comment' => ''),
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
			'name' => 'blue-white',
			'description' => 'blue-white',
			'author' => 'kimsia',
			'created' => '2010-05-13 00:00:00',
			'modified' => '2010-05-13 00:00:00',
			'available_for_all' => 1,
			'folder_name' => '',
			'shop_id' => NULL,
			'price' => '1.00'
		),
		array(
			'id' => '2',
			'name' => 'orange',
			'description' => 'orange',
			'author' => 'kimsia',
			'created' => '2010-05-13 00:00:00',
			'modified' => '2010-05-13 00:00:00',
			'available_for_all' => 1,
			'folder_name' => '',
			'shop_id' => NULL,
			'price' => '1.00'
		),
		array(
			'id' => '3',
			'name' => 'default',
			'description' => 'default',
			'author' => 'kimsia',
			'created' => '2010-07-06 12:55:23',
			'modified' => '2010-07-06 12:55:28',
			'available_for_all' => 1,
			'folder_name' => '2Cover',
			'shop_id' => NULL,
			'price' => '0.00'
		),
		array(
			'id' => '4',
			'name' => 'alt',
			'description' => 'alt',
			'author' => 'kimsia',
			'created' => '2010-07-08 00:00:00',
			'modified' => '2010-07-08 00:00:00',
			'available_for_all' => 1,
			'folder_name' => 'Alt',
			'shop_id' => NULL,
			'price' => '0.00'
		),
	);
}
