<?php
/* GiftCardType Fixture generated on: 2010-09-04 14:09:46 : 1283604826 */
class GiftCardTypeFixture extends CakeTestFixture {
	var $name = 'GiftCardType';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 3, 'key' => 'primary'),
		'type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'type' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>