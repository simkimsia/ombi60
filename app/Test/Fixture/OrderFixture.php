<?php
/* Order Fixture generated on: 2011-10-07 01:59:42 : 1317952782 */

/**
 * OrderFixture
 *
 */
class OrderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'billing_address_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'delivery_address_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'order_no' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'amount' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
		'status' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 4, 'collate' => NULL, 'comment' => ''),
		'cart_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'payment_status' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 2, 'collate' => NULL, 'comment' => ''),
		'fulfillment_status' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 2, 'collate' => NULL, 'comment' => ''),
		'shipped_weight' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'shipped_amount' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
		'currency' => array('type' => 'string', 'null' => false, 'default' => 'SGD', 'length' => 5, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'total_weight' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'past_checkout_point' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'contact_email' => array('type' => 'string', 'null' => true, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'order_line_item_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 5, 'collate' => NULL, 'comment' => ''),
		'delivered_to_country' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(

	);
}
