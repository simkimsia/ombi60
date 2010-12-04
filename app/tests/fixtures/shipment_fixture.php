<?php
/* Shipment Fixture generated on: 2010-09-16 03:09:06 : 1284601266 */
class ShipmentFixture extends CakeTestFixture {
	var $name = 'Shipment';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'order_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'completed' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'name' => array('type' => 'string', 'null' => false),
		'price' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '10,4'),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'order_id' => 1,
			'completed' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'price' => 1,
			'description' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>