<?php
/* ShopsPaymentModule Fixture generated on: 2011-10-07 18:18:58 : 1318011538 */

/**
 * ShopsPaymentModuleFixture
 *
 */
class ShopsPaymentModuleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'payment_module_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'default' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'active' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'display_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
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
			'shop_id' => '2',
			'payment_module_id' => '1',
			'default' => 0,
			'active' => 1,
			'display_name' => 'Cash On Delivery'
		),
	);
}
