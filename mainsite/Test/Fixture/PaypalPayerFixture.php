<?php
/* PaypalPayer Fixture generated on: 2011-01-01 11:01:04 : 1293879904 */
class PaypalPayerFixture extends CakeTestFixture {
	var $name = 'PaypalPayer';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'payer_id' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'payer_id' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>