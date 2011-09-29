<?php
/* Product Fixture generated on: 2011-09-29 02:27:30 : 1317263250 */

/**
 * ProductFixture
 *
 */
class ProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'price' => array('type' => 'float', 'null' => true, 'default' => '0.0000', 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'visible' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'weight' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'currency' => array('type' => 'string', 'null' => false, 'default' => 'SGD', 'length' => 5, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shipping_required' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'vendor_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'handle' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 150, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'product_type_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
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
			'shop_id' => '1',
			'title' => 'Dummy Product',
			'code' => NULL,
			'description' => NULL,
			'price' => '0.0000',
			'created' => '2010-05-20 08:00:24',
			'modified' => '2010-05-20 08:00:24',
			'visible' => 1,
			'weight' => '7000',
			'currency' => 'SGD',
			'shipping_required' => 1,
			'vendor_id' => '0',
			'handle' => 'dummy',
			'product_type_id' => '0'
		),
		array(
			'id' => '2',
			'shop_id' => '2',
			'title' => 'Dummy Product',
			'code' => NULL,
			'description' => NULL,
			'price' => '0.0000',
			'created' => '2011-07-08 11:54:47',
			'modified' => '2011-07-08 11:54:47',
			'visible' => 1,
			'weight' => '7000',
			'currency' => 'SGD',
			'shipping_required' => 1,
			'vendor_id' => '1',
			'handle' => 'dummy-product',
			'product_type_id' => '1'
		),
		array(
			'id' => '3',
			'shop_id' => '2',
			'title' => 'test product with no pic and no collection',
			'code' => '',
			'description' => '<p>test</p>',
			'price' => '23.0000',
			'created' => '2011-09-29 02:26:59',
			'modified' => '2011-09-29 02:26:59',
			'visible' => 1,
			'weight' => '2000',
			'currency' => 'SGD',
			'shipping_required' => 1,
			'vendor_id' => '0',
			'handle' => 'test-product-with-no-pic-and-no-collection',
			'product_type_id' => '0'
		),
	);
}
