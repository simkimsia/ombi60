<?php
/* ShippingRate Fixture generated on: 2010-09-08 08:09:16 : 1283927296 */
class ShippingRateFixture extends CakeTestFixture {
	var $name = 'ShippingRate';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'price' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,3'),
		'country_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 5),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'price' => 1,
			'country_id' => 1,
			'shop_id' => 1
		),
	);
}
?>