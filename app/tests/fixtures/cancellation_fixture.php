<?php
/* Cancellation Fixture generated on: 2010-12-13 03:12:28 : 1292210548 */
class CancellationFixture extends CakeTestFixture {
	var $name = 'Cancellation';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'short_reason' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'long_reason' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'short_reason' => 'Lorem ipsum dolor sit amet',
			'long_reason' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'shop_id' => 1,
			'created' => '2010-12-13 03:22:28',
			'modified' => '2010-12-13 03:22:28',
			'user_id' => 1
		),
	);
}
?>