<?php
/* SavedTheme Fixture generated on: 2010-08-02 10:08:26 : 1280738846 */
class SavedThemeFixture extends CakeTestFixture {
	var $name = 'SavedTheme';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'description' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'author' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'folder_name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'theme_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'author' => 'Lorem ipsum dolor sit amet',
			'created' => '2010-08-02 10:47:26',
			'modified' => '2010-08-02 10:47:26',
			'folder_name' => 'Lorem ipsum dolor sit amet',
			'shop_id' => 1,
			'theme_id' => 1
		),
	);
}
?>