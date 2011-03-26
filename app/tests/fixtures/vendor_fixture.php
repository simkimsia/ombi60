<?php
/* Vendor Fixture generated on: 2011-03-26 09:03:29 : 1301130389 */
class VendorFixture extends CakeTestFixture {
	var $name = 'Vendor';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'shop_id' => 1,
			'created' => '2011-03-26 09:06:29',
			'modified' => '2011-03-26 09:06:29',
			'name' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>