<?php
/* VariantOption Fixture generated on: 2011-09-28 10:27:30 : 1317205650 */

/**
 * VariantOptionFixture
 *
 */
class VariantOptionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 14, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'variant_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 12, 'collate' => NULL, 'comment' => ''),
		'field' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'value' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'order' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 2, 'collate' => NULL, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'variant_id' => '1',
			'field' => 'title',
			'value' => 'Default Title',
			'order' => '0'
		),
		array(
			'id' => '2',
			'variant_id' => '2',
			'field' => 'title',
			'value' => 'Default Title',
			'order' => '0'
		),
	);
}
