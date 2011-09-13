<?php
/* ProductsInGroup Fixture generated on: 2011-03-26 08:03:13 : 1301129833 */
class ProductsInGroupFixture extends CakeTestFixture {
	var $name = 'ProductsInGroup';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'product_group_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'product_id' => 1,
			'product_group_id' => 1
		),
	);
}
?>