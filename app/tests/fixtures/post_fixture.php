<?php
/* Post Fixture generated on: 2010-09-02 04:09:19 : 1283395219 */
class PostFixture extends CakeTestFixture {
	var $name = 'Post';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'blog_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'author_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'slug' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'body' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'no_comments' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'allow_comments' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'allow_pingback' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'blog_id' => 1,
			'author_id' => 1,
			'status' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'slug' => 'Lorem ipsum dolor sit amet',
			'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'no_comments' => 1,
			'allow_comments' => 1,
			'allow_pingback' => 1,
			'created' => '2010-09-02 04:40:19',
			'modified' => '2010-09-02 04:40:19'
		),
	);
}
?>