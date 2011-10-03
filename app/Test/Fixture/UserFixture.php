<?php
/* User Fixture generated on: 2011-09-30 18:42:27 : 1317408147 */

/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'full_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'name_to_call' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'last_login_on' => array('type' => 'timestamp', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'language_id' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 5, 'collate' => NULL, 'comment' => ''),
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
			'email' => 'owner@shop001.com',
			'password' => '78e8f77082028fa96a619aa568aa3ca88a72ec8e',
			'group_id' => '3',
			'full_name' => 'Barry Allen',
			'name_to_call' => 'Barry',
			'last_login_on' => NULL,
			'status' => 1,
			'created' => '2011-07-08 11:54:46',
			'modified' => '2011-07-08 11:54:46',
			'language_id' => '1'
		),
		array(
			'id' => '2',
			'email' => 'f4lvh$w0@ombi60.com',
			'password' => '6d29cb929f8cccd4db7d7d0963108a3d3c9650aa',
			'group_id' => '5',
			'full_name' => 'casual',
			'name_to_call' => 'casual',
			'last_login_on' => NULL,
			'status' => 1,
			'created' => '2011-07-08 11:54:59',
			'modified' => '2011-07-08 11:54:59',
			'language_id' => '1'
		),

	);
}
