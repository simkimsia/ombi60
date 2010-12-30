<?php
/* PaypalPaymentModule Fixture generated on: 2010-12-30 07:12:41 : 1293693221 */
class PaypalPaymentModuleFixture extends CakeTestFixture {
	var $name = 'PaypalPaymentModule';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'shop_payment_module_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'account_email' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'unique_spm' => array('column' => 'shop_payment_module_id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'shop_payment_module_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'account_email' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>