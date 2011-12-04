<?php
/* PaypalPayersPayment Fixture generated on: 2011-01-01 11:01:49 : 1293879649 */
class PaypalPayersPaymentFixture extends CakeTestFixture {
	var $name = 'PaypalPayersPayment';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'paypal_payer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'payment_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => '4d1f0961-6778-4162-8246-19641507707a',
			'paypal_payer_id' => 1,
			'payment_id' => 1
		),
	);
}
?>