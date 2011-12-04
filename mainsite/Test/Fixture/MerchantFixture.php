<?php
/* Merchant Fixture generated on: 2011-09-22 09:57:02 : 1316685422 */

/**
 * MerchantFixture
 *
 */
class MerchantFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'owner' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
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
			'owner' => 1,
			'shop_id' => '2',
			'user_id' => '1'
		),
	);
}
