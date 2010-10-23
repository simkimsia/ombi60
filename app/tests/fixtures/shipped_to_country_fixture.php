<?php
/* ShippedToCountry Fixture generated on: 2010-09-09 09:09:32 : 1284017672 */
class ShippedToCountryFixture extends CakeTestFixture {
	var $name = 'ShippedToCountry';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'country_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 5),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'country_id' => 1,
			'shop_id' => 1
		),
	);
}
?>