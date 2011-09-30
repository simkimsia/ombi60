<?php
/* Customer Fixture generated on: 2011-09-30 18:42:14 : 1317408134 */

/**
 * CustomerFixture
 *
 */
class CustomerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'identity_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
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
			'identity_code' => NULL,
			'shop_id' => '3',
			'user_id' => '4'
		),
		array(
			'id' => '2',
			'identity_code' => NULL,
			'shop_id' => '3',
			'user_id' => '5'
		),
		array(
			'id' => '3',
			'identity_code' => NULL,
			'shop_id' => '2',
			'user_id' => '3'
		),
		array(
			'id' => '4',
			'identity_code' => NULL,
			'shop_id' => '2',
			'user_id' => '3'
		),
		array(
			'id' => '5',
			'identity_code' => NULL,
			'shop_id' => '2',
			'user_id' => '4'
		),
		array(
			'id' => '6',
			'identity_code' => NULL,
			'shop_id' => '2',
			'user_id' => '5'
		),
	);
}
