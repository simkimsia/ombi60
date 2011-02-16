<?php
/* Link Fixture generated on: 2011-01-04 12:01:32 : 1294144472 */
class LinkFixture extends CakeTestFixture {
	var $name = 'Link';

	var $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'route' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'link_list_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => '4d2313d8-7bf0-443b-a3e3-0c2d1507707a',
			'name' => 'Lorem ipsum dolor sit amet',
			'route' => 'Lorem ipsum dolor sit amet',
			'link_list_id' => 1
		),
	);
}
?>