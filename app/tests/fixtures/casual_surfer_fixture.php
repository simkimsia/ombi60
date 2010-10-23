<?php
/* CasualSurfer Fixture generated on: 2010-09-28 03:09:39 : 1285635639 */
class CasualSurferFixture extends CakeTestFixture {
	var $name = 'CasualSurfer';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'shop' => array('column' => 'shop_id', 'unique' => 0), 'user' => array('column' => 'user_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'shop_id' => 1,
			'user_id' => 1
		),
	);
}
?>