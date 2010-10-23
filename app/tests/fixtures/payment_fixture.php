<?php
/* Payment Fixture generated on: 2010-06-08 08:06:05 : 1275980225 */
class PaymentFixture extends CakeTestFixture {
	var $name = 'Payment';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'payment_module_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'completed' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'order_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'FK_payments_orders' => array('column' => 'order_id', 'unique' => 0), 'FK_payments_payment_modules' => array('column' => 'payment_module_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'payment_module_id' => 1,
			'completed' => 1,
			'order_id' => 1
		),
	);
}
?>