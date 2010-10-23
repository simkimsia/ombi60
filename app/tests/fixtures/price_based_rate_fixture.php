<?php
/* PriceBasedRate Fixture generated on: 2010-09-08 08:09:43 : 1283927323 */
class PriceBasedRateFixture extends CakeTestFixture {
	var $name = 'PriceBasedRate';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'min_price' => array('type' => 'float', 'null' => false, 'default' => '0.000', 'length' => '10,3'),
		'max_price' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,3'),
		'shipping_rate_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'min_price' => 1,
			'max_price' => 1,
			'shipping_rate_id' => 1
		),
	);
}
?>