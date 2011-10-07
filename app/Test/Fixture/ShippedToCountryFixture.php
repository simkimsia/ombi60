<?php
/* ShippedToCountry Fixture generated on: 2011-10-07 02:15:32 : 1317953732 */

/**
 * ShippedToCountryFixture
 *
 */
class ShippedToCountryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'country_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 5, 'collate' => NULL, 'comment' => ''),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
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
			'country_id' => '0',
			'shop_id' => '1'
		),
		array(
			'id' => '2',
			'country_id' => '192',
			'shop_id' => '1'
		),
		array(
			'id' => '3',
			'country_id' => '192',
			'shop_id' => '2'
		),
		array(
			'id' => '4',
			'country_id' => '0',
			'shop_id' => '2'
		),
	);
}
