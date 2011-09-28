<?php
/* Shop Fixture generated on: 2011-09-28 10:24:55 : 1317205495 */

/**
 * ShopFixture
 *
 */
class ShopFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'collate' => NULL, 'comment' => ''),
		'saved_theme_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'deny_access' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'primary_domain' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'permanent_domain' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'all_product_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 7, 'collate' => NULL, 'comment' => ''),
		'visible_product_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 7, 'collate' => NULL, 'comment' => ''),
		'product_group_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 7, 'collate' => NULL, 'comment' => ''),
		'vendor_count' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 7, 'collate' => NULL, 'comment' => ''),
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
			'name' => 'a',
			'created' => NULL,
			'modified' => NULL,
			'status' => 1,
			'saved_theme_id' => '0',
			'deny_access' => 0,
			'url' => NULL,
			'primary_domain' => 'http://a.ombi60.com/',
			'permanent_domain' => NULL,
			'email' => NULL,
			'all_product_count' => '1',
			'visible_product_count' => '1',
			'product_group_count' => '0',
			'vendor_count' => '0'
		),
		array(
			'id' => '2',
			'name' => 'shop001',
			'created' => '2011-07-08 11:54:46',
			'modified' => '2011-07-08 11:54:47',
			'status' => 1,
			'saved_theme_id' => '1',
			'deny_access' => 0,
			'url' => 'http://shop001.ombi60.localhost',
			'primary_domain' => 'http://shop001.ombi60.localhost',
			'permanent_domain' => 'shop001.ombi60.localhost',
			'email' => 'owner@shop001.com',
			'all_product_count' => '1',
			'visible_product_count' => '1',
			'product_group_count' => '0',
			'vendor_count' => '0'
		),
	);
}
