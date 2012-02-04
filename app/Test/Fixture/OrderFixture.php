<?php
/* Order Fixture generated on: 2011-10-09 07:15:35 : 1318144535 */

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
		'shipping_fee' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '10,4', 'collate' => NULL, 'comment' => ''),
		'status' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'collate' => NULL, 'comment' => ''),
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
		array(
			'id' => '4e8d8ef9-71a4-4a69-8dbf-04b01507707a',
			'shop_id' => '2',
			'customer_id' => '1',
			'billing_address_id' => '1',
			'delivery_address_id' => '2',
			'order_no' => '10001',
			'created' => '2011-10-06 11:20:25',
			'amount' => '23.0000',
			'shipping_fee' => '0.0000',
			'status' => '1',
			'cart_id' => '4e895a91-b374-4a1a-947c-0b701507707a',
			'payment_status' => '0',
			'fulfillment_status' => '1',
			'shipped_weight' => '15000',
			'shipped_amount' => '23.0000',
			'currency' => 'SGD',
			'total_weight' => '15000',
			'past_checkout_point' => FALSE,
			'contact_email' => 'guest_customer@ombi60.com',
			'order_line_item_count' => '1',
			'delivered_to_country' => '192'
		),
		array(
			'id' => '4e91458a-b0f8-452c-ab84-1d351507707a',
			'shop_id' => '2',
			'customer_id' => '1',
			'billing_address_id' => '1',
			'delivery_address_id' => '2',
			'order_no' => '10002',
			'created' => '2011-10-09 06:56:10',
			'amount' => '34.0000',
			'shipping_fee' => '0.0000',
			'status' => '1',
			'cart_id' => '4e9144d7-55e4-44a6-a2f1-1f721507707a',
			'payment_status' => '0',
			'fulfillment_status' => '1',
			'shipped_weight' => '22000',
			'shipped_amount' => '34.0000',
			'currency' => 'SGD',
			'total_weight' => '22000',
			'past_checkout_point' => 0,
			'contact_email' => 'guest_customer@ombi60.com',
			'order_line_item_count' => '2',
			'delivered_to_country' => '192'
		),
		// PAID and CANCELLED
		array(
			'id' => '4e8d8ef9-71a4-4a69-8dbf-04b01507707b',
			'shop_id' => '2',
			'customer_id' => '1',
			'billing_address_id' => '1',
			'delivery_address_id' => '2',
			'order_no' => '10001',
			'created' => '2011-10-06 11:20:25',
			'amount' => '23.0000',
			'shipping_fee' => '0.0000',
			'status' => '2',
			'cart_id' => '4e895a91-b374-4a1a-947c-0b701507707b',
			'payment_status' => '2',
			'fulfillment_status' => '1',
			'shipped_weight' => '15000',
			'shipped_amount' => '23.0000',
			'currency' => 'SGD',
			'total_weight' => '15000',
			'past_checkout_point' => FALSE,
			'contact_email' => 'guest_customer@ombi60.com',
			'order_line_item_count' => '1',
			'delivered_to_country' => '192'
		),
		// AUTHORIZED and CLOSED
		array(
			'id' => '4e8d8ef9-71a4-4a69-8dbf-04b01507707c',
			'shop_id' => '2',
			'customer_id' => '1',
			'billing_address_id' => '1',
			'delivery_address_id' => '2',
			'order_no' => '10001',
			'created' => '2011-10-06 11:20:25',
			'amount' => '23.0000',
			'shipping_fee' => '0.0000',
			'status' => '3',
			'cart_id' => '4e895a91-b374-4a1a-947c-0b701507707c',
			'payment_status' => '1',
			'fulfillment_status' => '1',
			'shipped_weight' => '15000',
			'shipped_amount' => '23.0000',
			'currency' => 'SGD',
			'total_weight' => '15000',
			'past_checkout_point' => FALSE,
			'contact_email' => 'guest_customer@ombi60.com',
			'order_line_item_count' => '1',
			'delivered_to_country' => '192'
		),
		

	);
}
