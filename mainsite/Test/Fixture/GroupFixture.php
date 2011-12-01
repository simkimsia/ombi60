<?php
/* Group Fixture generated on: 2011-10-12 14:26:04 : 1318429564 */

/**
 * GroupFixture
 *
 */
class GroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	var $records = array(
		array(
			'id' => 1,
			'name' => 'administrators',
			'created' => '2010-01-01 00:00:00',
			'modified' => '2010-01-01 00:00:00',
		),
		array(
			'id' => 2,
			'name' => 'editors',
			'created' => '2010-01-01 00:00:00',
			'modified' => '2010-01-01 00:00:00',
		),
		array(
			'id' => 3,
			'name' => 'merchants',
			'created' => '2010-01-01 00:00:00',
			'modified' => '2010-01-01 00:00:00',
		),
		array(
			'id' => 4,
			'name' => 'customers',
			'created' => '2010-01-01 00:00:00',
			'modified' => '2010-01-01 00:00:00',
		),
	);
}
