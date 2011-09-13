<?php
/* Blog Fixture generated on: 2010-09-02 04:09:39 : 1283395059 */
class BlogFixture extends CakeTestFixture {
	var $name = 'Blog';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'short_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'theme' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'short_name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'theme' => 'Lorem ipsum dolor sit amet',
			'created' => '2010-09-02 04:37:39',
			'modified' => '2010-09-02 04:37:39'
		),
	);
}
?>