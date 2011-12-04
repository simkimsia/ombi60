<?php
/* Shipment Fixture generated on: 2011-10-07 18:18:24 : 1318011504 */

/**
 * ShipmentFixture
 *
 */
class ShipmentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'order_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'completed' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'price' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
	public $records = array(
	);
}
