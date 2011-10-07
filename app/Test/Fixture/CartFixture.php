<?php
/* Cart Fixture generated on: 2011-10-05 05:56:30 : 1317794190 */

/**
 * CartFixture
 *
 */
class CartFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'amount' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
		'status' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'total_weight' => array('type' => 'float', 'null' => false, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'currency' => array('type' => 'string', 'null' => false, 'default' => 'SGD', 'length' => 5, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shipped_amount' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
		'shipped_weight' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'past_checkout_point' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'cart_item_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 7, 'collate' => NULL, 'comment' => ''),
		'note' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'attributes' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
			'id' => '4e895a91-b374-4a1a-947c-0b701507707a',
			'shop_id' => '2',
			'user_id' => '2',
			'created' => '2011-10-01 05:16:44',
			'amount' => '23.0000',
			'status' => 1,
			'total_weight' => '15000',
			'currency' => 'SGD',
			'shipped_amount' => '23.0000',
			'shipped_weight' => '2000',
			'past_checkout_point' => 0,
			'cart_item_count' => '1',
			'note' => NULL,
			'attributes' => NULL
		),
	);
}
