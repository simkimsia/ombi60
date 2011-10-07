<?php
/* WeightBasedRate Fixture generated on: 2011-10-07 02:15:52 : 1317953752 */

/**
 * WeightBasedRateFixture
 *
 */
class WeightBasedRateFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'min_weight' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'max_weight' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
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
			'min_weight' => '10000',
			'max_weight' => '20000',
			'shipping_rate_id' => '1'
		),
		array(
			'id' => '2',
			'min_weight' => '20000',
			'max_weight' => '50000',
			'shipping_rate_id' => '2'
		),
		array(
			'id' => '3',
			'min_weight' => '10000',
			'max_weight' => '20000',
			'shipping_rate_id' => '3'
		),
		array(
			'id' => '4',
			'min_weight' => '20000',
			'max_weight' => '50000',
			'shipping_rate_id' => '4'
		),
		array(
			'id' => '5',
			'min_weight' => '10000',
			'max_weight' => '20000',
			'shipping_rate_id' => '5'
		),
		array(
			'id' => '6',
			'min_weight' => '20000',
			'max_weight' => '50000',
			'shipping_rate_id' => '6'
		),
	);
}
