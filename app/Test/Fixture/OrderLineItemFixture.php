<?php
/* OrderLineItem Fixture generated on: 2011-10-07 02:08:47 : 1317953327 */

/**
 * OrderLineItemFixture
 *
 */
class OrderLineItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'order_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'product_price' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
		'product_quantity' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4, 'collate' => NULL, 'comment' => ''),
		'status' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 4, 'collate' => NULL, 'comment' => ''),
		'product_title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'product_weight' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'currency' => array('type' => 'string', 'null' => false, 'default' => 'SGD', 'length' => 5, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shipping_required' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'variant_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 14, 'collate' => NULL, 'comment' => ''),
		'variant_title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
			'order_id' => '4e8d8ef9-71a4-4a69-8dbf-04b01507707a',
			'product_id' => '3',
			'product_price' => '23.0000',
			'product_quantity' => '1',
			'status' => '1',
			'product_title' => 'test product with no pic and no collection',
			'product_weight' => '15000',
			'currency' => 'SGD',
			'shipping_required' => 1,
			'variant_id' => '3',
			'variant_title' => 'Default Title'
		),
	);
}
