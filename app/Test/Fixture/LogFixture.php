<?php
/* Log Fixture generated on: 2011-09-28 10:35:40 : 1317206140 */

/**
 * LogFixture
 *
 */
class LogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'description' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'model' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'model_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'action' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'change' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'title' => 'Dummy Product',
			'created' => '2011-07-08 11:54:47',
			'description' => 'Product "Dummy Product" (2) added by System.',
			'model' => 'Product',
			'model_id' => '2',
			'action' => 'add',
			'user_id' => '0',
			'change' => 'price, visible, weight, currency, shipping_required, vendor_id, product_type_id, shop_id, title, handle, created'
		),
		array(
			'id' => '2',
			'title' => 'Dummy Product',
			'created' => '2011-07-08 11:54:48',
			'description' => 'Product (2) updated by System.',
			'model' => 'Product',
			'model_id' => '2',
			'action' => 'edit',
			'user_id' => '0',
			'change' => 'shop_id, vendor_id, product_type_id'
		),
	);
}
