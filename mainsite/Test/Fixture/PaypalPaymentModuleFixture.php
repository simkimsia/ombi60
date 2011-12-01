<?php
/* PaypalPaymentModule Fixture generated on: 2011-11-23 09:36:03 : 1322040963 */

/**
 * PaypalPaymentModuleFixture
 *
 */
class PaypalPaymentModuleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'shop_payment_module_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'unique', 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'account_email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'unique_spm' => array('column' => 'shop_payment_module_id', 'unique' => 1)),
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
			'shop_payment_module_id' => '2',
			'name' => 'Paypal Express Checkout',
			'account_email' => 'owner@shop123.com'
		),
	);
}
