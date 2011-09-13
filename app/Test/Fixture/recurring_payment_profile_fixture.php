<?php
/* RecurringPaymentProfile Fixture generated on: 2010-12-13 08:12:57 : 1292230437 */
class RecurringPaymentProfileFixture extends CakeTestFixture {
	var $name = 'RecurringPaymentProfile';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'gateway' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'method' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'gateway_reference_id' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'gateway' => 'Lorem ipsum dolor sit amet',
			'method' => 'Lorem ipsum dolor sit amet',
			'shop_id' => 1,
			'gateway_reference_id' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>