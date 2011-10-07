<?php
/* Address Fixture generated on: 2011-10-06 08:09:30 : 1317888570 */

/**
 * AddressFixture
 *
 */
class AddressFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'address' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'city' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'region' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'zip_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'country' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 5, 'collate' => NULL, 'comment' => ''),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'type' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 2, 'collate' => NULL, 'comment' => ''),
		'full_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
			'address' => 'Billing Address St. Block 123 #01-911',
			'city' => 'Singapore',
			'region' => NULL,
			'zip_code' => '111111',
			'country' => '192',
			'customer_id' => '1',
			'type' => '1',
			'full_name' => 'G. Cherry'
		),
		
		array(
			'id' => '2',
			'address' => 'Delivery Address Block 123 #01-911',
			'city' => 'Singapore',
			'region' => NULL,
			'zip_code' => '111111',
			'country' => '192',
			'customer_id' => '1',
			'type' => '2',
			'full_name' => 'G. Cherry'
		),
	);
}
