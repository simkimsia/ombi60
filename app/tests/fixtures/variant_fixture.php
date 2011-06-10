<?php
/* Variant Fixture generated on: 2011-06-10 23:06:11 : 1307746871 */
class VariantFixture extends CakeTestFixture {
	var $name = 'Variant';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 12, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'product_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'sku_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'weight' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'currency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 5),
		'shipping_required' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'price' => array('type' => 'float', 'null' => true, 'default' => NULL, 'length' => '10,4'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'product_id' => 1,
			'sku_code' => 'Lorem ipsum dolor sit amet',
			'weight' => 1,
			'created' => '2011-06-10 23:01:11',
			'modified' => '2011-06-10 23:01:11',
			'currency' => 'Lor',
			'shipping_required' => 1,
			'price' => 1
		),
	);
}
?>