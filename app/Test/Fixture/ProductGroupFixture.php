<?php
/* ProductGroup Fixture generated on: 2011-10-25 08:42:05 : 1319532125 */

/**
 * ProductGroupFixture
 *
 */
class ProductGroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'title' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'all_product_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 7, 'collate' => NULL, 'comment' => ''),
		'handle' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 150, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'vendor_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 7, 'collate' => NULL, 'comment' => ''),
		'visible' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'type' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'visible_product_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 7, 'collate' => NULL, 'comment' => ''),
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
			'title' => 'Frontpage',
			'shop_id' => '2',
			'created' => '2011-07-08 11:54:48',
			'modified' => '2011-07-08 11:54:48',
			'description' => NULL,
			'all_product_count' => '1',
			'handle' => 'frontpage',
			'vendor_count' => '0',
			'visible' => 1,
			'type' => 0,
			'visible_product_count' => '1'
		),
		array(
			'id' => '2',
			'title' => 'smart collection 1',
			'shop_id' => '2',
			'created' => '2011-10-25 08:40:37',
			'modified' => '2011-10-25 08:40:37',
			'description' => '<p>more than 1 dollar</p>',
			'all_product_count' => '2',
			'handle' => 'smart-collection-1',
			'vendor_count' => '0',
			'visible' => 1,
			'type' => 1,
			'visible_product_count' => '2'
		),
		array(
			'id' => '3',
			'title' => 'Shirts',
			'shop_id' => '2',
			'created' => '2011-10-25 08:40:37',
			'modified' => '2011-10-25 08:40:37',
			'description' => '',
			'all_product_count' => '0',
			'handle' => 'shirts',
			'vendor_count' => '0',
			'visible' => 1,
			'type' => 0,
			'visible_product_count' => '0'
		)
	);
}
