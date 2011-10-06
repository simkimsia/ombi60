<?php
/* WeightBasedRate Fixture generated on: 2010-09-08 08:09:06 : 1283927346 */
class WeightBasedRateFixture extends CakeTestFixture {
	var $name = 'WeightBasedRate';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'min_weight' => array('type' => 'float', 'null' => false, 'default' => '0.0000', 'length' => '10,4'),
		'max_weight' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,4'),
		'shipping_rate_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'min_weight' => 1,
			'max_weight' => 1,
			'shipping_rate_id' => 1
		),
	);
}
?>