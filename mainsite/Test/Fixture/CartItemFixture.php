<?php
/* CartItem Fixture generated on: 2011-10-09 07:05:17 : 1318143917 */

/**
 * CartItemFixture
 *
 */
class CartItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'cart_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'product_price' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
		'product_quantity' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4, 'collate' => NULL, 'comment' => ''),
		'visible' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'product_title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'product_weight' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'currency' => array('type' => 'string', 'null' => false, 'default' => 'SGD', 'length' => 5, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shipping_required' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'previous_price' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
		'previous_currency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 5, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'variant_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 14, 'collate' => NULL, 'comment' => ''),
		'variant_title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'unique_variant_card_index' => array('column' => array('cart_id', 'variant_id'), 'unique' => 1)),
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
			'cart_id' => '4e895a91-b374-4a1a-947c-0b701507707a',
			'product_id' => '3',
			'product_price' => '23.0000',
			'product_quantity' => '1',
			'visible' => true,
			'product_title' => 'test product with no pic and no collection',
			'product_weight' => '15000',
			'currency' => 'SGD',
			'shipping_required' => true,
			'previous_price' => '23.0000',
			'previous_currency' => 'SGD',
			'variant_id' => '3',
			'variant_title' => 'Default Title'
		),
		array(
			'id' => '2',
			'cart_id' => '4e9144d7-55e4-44a6-a2f1-1f721507707a',
			'product_id' => '2',
			'product_price' => '11.0000',
			'product_quantity' => '1',
			'visible' => true,
			'product_title' => 'Dummy Product',
			'product_weight' => '7000',
			'currency' => 'SGD',
			'shipping_required' => true,
			'previous_price' => '11.0000',
			'previous_currency' => 'SGD',
			'variant_id' => '2',
			'variant_title' => 'Default Title'
		),
		array(
			'id' => '3',
			'cart_id' => '4e9144d7-55e4-44a6-a2f1-1f721507707a',
			'product_id' => '3',
			'product_price' => '23.0000',
			'product_quantity' => '1',
			'visible' => true,
			'product_title' => 'test product with no pic and no collection',
			'product_weight' => '15000',
			'currency' => 'SGD',
			'shipping_required' => true,
			'previous_price' => '23.0000',
			'previous_currency' => 'SGD',
			'variant_id' => '3',
			'variant_title' => 'Default Title'
		),
	);
}
