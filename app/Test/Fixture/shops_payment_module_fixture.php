<?php
/* ShopsPaymentModule Fixture generated on: 2010-06-10 02:06:01 : 1276131481 */
class ShopsPaymentModuleFixture extends CakeTestFixture {
	var $name = 'ShopsPaymentModule';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'payment_module_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'shop_id' => 1,
			'payment_module_id' => 1
		),
	);
}
?>