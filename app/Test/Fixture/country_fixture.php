<?php
/* Country Fixture generated on: 2010-09-08 08:09:41 : 1283927081 */
class CountryFixture extends CakeTestFixture {
	var $name = 'Country';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'iso' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2, 'key' => 'unique'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 80, 'key' => 'unique'),
		'printable_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 80, 'key' => 'unique'),
		'iso3' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'key' => 'unique'),
		'numcode' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 6),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'unique_iso' => array('column' => 'iso', 'unique' => 1), 'unique_name' => array('column' => 'name', 'unique' => 1), 'unique_printable_name' => array('column' => 'printable_name', 'unique' => 1), 'unique_iso3' => array('column' => 'iso3', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'iso' => '',
			'name' => 'Lorem ipsum dolor sit amet',
			'printable_name' => 'Lorem ipsum dolor sit amet',
			'iso3' => 'L',
			'numcode' => 1
		),
	);
}
?>