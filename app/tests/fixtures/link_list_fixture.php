<?php
/* LinkList Fixture generated on: 2011-01-04 12:01:16 : 1294144456 */
class LinkListFixture extends CakeTestFixture {
	var $name = 'LinkList';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'deletable' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'shop_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'deletable' => 1
		),
	);
}
?>