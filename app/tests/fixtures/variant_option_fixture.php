<?php
/* VariantOption Fixture generated on: 2011-06-19 21:06:04 : 1308519964 */
class VariantOptionFixture extends CakeTestFixture {
	var $name = 'VariantOption';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 14, 'key' => 'primary'),
		'variant_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 12),
		'product_option_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 12),
		'value' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'order' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 2),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'variant_id' => 1,
			'product_option_id' => 1,
			'value' => 'Lorem ipsum dolor sit amet',
			'order' => 1
		),
	);
}
?>