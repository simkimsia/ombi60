<?php
/* Variant Fixture generated on: 2011-09-30 18:48:08 : 1317408488 */

/**
 * VariantFixture
 *
 */
class VariantFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 12, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'product_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'sku_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'weight' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'currency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 5, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shipping_required' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'price' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
		'order' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 2, 'collate' => NULL, 'comment' => ''),
		'compare_with_price' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
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
			'title' => 'Default Title',
			'product_id' => '1',
			'sku_code' => NULL,
			'weight' => '7000',
			'created' => NULL,
			'modified' => NULL,
			'currency' => 'SGD',
			'shipping_required' => 1,
			'price' => '0.0000',
			'order' => '0',
			'compare_with_price' => NULL
		),
		array(
			'id' => '2',
			'title' => 'Default Title',
			'product_id' => '2',
			'sku_code' => NULL,
			'weight' => '7000',
			'created' => '2011-07-08 11:54:47',
			'modified' => '2011-07-08 11:54:47',
			'currency' => 'SGD',
			'shipping_required' => 1,
			'price' => '11.0000',
			'order' => '0',
			'compare_with_price' => NULL
		),
		array(
			'id' => '3',
			'title' => 'Default Title',
			'product_id' => '3',
			'sku_code' => '',
			'weight' => '15000',
			'created' => '2011-09-29 02:26:59',
			'modified' => '2011-09-29 02:26:59',
			'currency' => 'SGD',
			'shipping_required' => 1,
			'price' => '23.0000',
			'order' => '0',
			'compare_with_price' => NULL
		),
	);
}
