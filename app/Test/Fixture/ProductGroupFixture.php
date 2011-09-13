<?php
/* ProductGroup Fixture generated on: 2011-03-26 08:03:38 : 1301129798 */
class ProductGroupFixture extends CakeTestFixture {
	var $name = 'ProductGroup';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'product_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 7),
		'handle' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'vendor_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 7),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'shop_id' => 1,
			'created' => '2011-03-26 08:56:38',
			'modified' => '2011-03-26 08:56:38',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'product_count' => 1,
			'handle' => 'Lorem ipsum dolor sit amet',
			'vendor_count' => 1
		),
	);
}
?>