<?php
/* PriceBasedRate Fixture generated on: 2011-10-07 18:19:14 : 1318011554 */

/**
 * PriceBasedRateFixture
 *
 */
class PriceBasedRateFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'min_price' => array('type' => 'float', 'null' => false, 'default' => '0.000', 'length' => '10,3', 'collate' => NULL, 'comment' => ''),
		'max_price' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,3', 'collate' => NULL, 'comment' => ''),
		'shipping_rate_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
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
			'min_price' => '10.000',
			'max_price' => NULL,
			'shipping_rate_id' => '7'
		),
	);
}
