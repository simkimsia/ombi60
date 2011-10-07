<?php
/* PaymentModule Fixture generated on: 2011-10-07 02:16:30 : 1317953790 */

/**
 * PaymentModuleFixture
 *
 */
class PaymentModuleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'group' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
			'name' => 'Custom',
			'group' => 'Custom'
		),
		array(
			'id' => '2',
			'name' => 'Paypal',
			'group' => 'Payment Gateway'
		),
		array(
			'id' => '3',
			'name' => 'Cheque',
			'group' => 'Custom'
		),
		array(
			'id' => '4',
			'name' => 'Internet Banking',
			'group' => 'Custom'
		),
	);
}
