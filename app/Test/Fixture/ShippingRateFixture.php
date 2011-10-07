<?php
/* ShippingRate Fixture generated on: 2011-10-07 02:15:40 : 1317953740 */

/**
 * ShippingRateFixture
 *
 */
class ShippingRateFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'price' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,3', 'collate' => NULL, 'comment' => ''),
		'shipped_to_country_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
			'name' => 'Standard Shipping',
			'price' => '10.000',
			'shipped_to_country_id' => '2',
			'description' => 'From 10kg to 20kg'
		),
		array(
			'id' => '2',
			'name' => 'Heavy Duty Shipping',
			'price' => '25.000',
			'shipped_to_country_id' => '2',
			'description' => 'From 20kg to 50kg'
		),
		array(
			'id' => '3',
			'name' => 'Standard Shipping',
			'price' => '10.000',
			'shipped_to_country_id' => '3',
			'description' => 'From 10kg to 20kg'
		),
		array(
			'id' => '4',
			'name' => 'Heavy Duty',
			'price' => '25.000',
			'shipped_to_country_id' => '3',
			'description' => 'From 20kg to 50kg'
		),
		array(
			'id' => '5',
			'name' => 'Standard Shipping',
			'price' => '10.000',
			'shipped_to_country_id' => '4',
			'description' => 'From 10kg to 20kg'
		),
		array(
			'id' => '6',
			'name' => 'Heavy Duty',
			'price' => '25.000',
			'shipped_to_country_id' => '4',
			'description' => 'From 20kg to 50kg'
		),
	);
}
