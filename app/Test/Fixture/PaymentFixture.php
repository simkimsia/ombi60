<?php
/* Payment Fixture generated on: 2011-10-07 16:37:19 : 1318005439 */

/**
 * PaymentFixture
 *
 */
class PaymentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'shops_payment_module_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'order_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'gateway_name' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'transaction_id_from_gateway' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => NULL, 'comment' => ''),
		'token_from_gateway' => array('type' => 'string', 'null' => true, 'default' => '\'\'', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'ordertime_from_gateway' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'currencycode_from_gateway' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'feeamt_from_gateway' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '9,2', 'collate' => NULL, 'comment' => ''),
		'settleamt_from_gateway' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,2', 'collate' => NULL, 'comment' => ''),
		'taxamt_from_gateway' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '9,2', 'collate' => NULL, 'comment' => ''),
		'exchangerate_from_gateway' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '17,7', 'collate' => NULL, 'comment' => ''),
		'paymentstatus_from_gateway' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'pendingreason_from_gateway' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'reasoncode_from_gateway' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
