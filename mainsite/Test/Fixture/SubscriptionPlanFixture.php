<?php
/* SubscriptionPlan Fixture generated on: 2010-12-21 03:12:03 : 1292901783 */
class SubscriptionPlanFixture extends CakeTestFixture {
	var $name = 'SubscriptionPlan';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'currency_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10),
		'price' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '7,2'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 'Lorem ipsum dolor sit amet',
			'currency_code' => 'Lorem ip',
			'price' => 1
		),
	);
}
?>