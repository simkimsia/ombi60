<?php
/* RecurringPaymentProfile Fixture generated on: 2011-12-14 05:09:22 : 1323839362 */

/**
 * RecurringPaymentProfileFixture
 *
 */
class RecurringPaymentProfileFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'gateway' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'method' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'gateway_reference_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'status' => array('type' => 'string', 'null' => true, 'default' => 'active', 'length' => 50, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
			'gateway' => 'paydollar',
			'method' => 'AddSchPay API',
			'shop_id' => '2',
			'gateway_reference_id' => '11445',
			'created' => '2011-07-08 11:54:50',
			'modified' => '2011-07-08 11:54:50',
			'status' => 'active'
		),
	);
}
