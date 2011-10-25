<?php
/* ProductsInGroup Fixture generated on: 2011-10-25 08:42:18 : 1319532138 */

/**
 * ProductsInGroupFixture
 *
 */
class ProductsInGroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'product_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'product_group_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
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
			'product_id' => '2',
			'product_group_id' => '1'
		),
		array(
			'id' => '2',
			'product_id' => '2',
			'product_group_id' => '2'
		),
		array(
			'id' => '3',
			'product_id' => '3',
			'product_group_id' => '2'
		),
		array(
			'id' => '4',
			'product_id' => '4',
			'product_group_id' => '2'
		),
		array(
			'id' => '5',
			'product_id' => '5',
			'product_group_id' => '2'
		),
	);
}
