<?php
/* Domain Fixture generated on: 2011-09-21 16:58:54 : 1316624334 */

/**
 * DomainFixture
 *
 */
class DomainFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'domain' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'shop_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'primary' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'always_redirect_here' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'shop_web_address' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'UniqueDomain' => array('column' => 'domain', 'unique' => 1)),
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
			'domain' => 'http://ombi60.localhost',
			'shop_id' => '1',
			'primary' => 1,
			'always_redirect_here' => 0,
			'shop_web_address' => 0
		),
		array(
			'id' => '2',
			'domain' => 'http://localhost',
			'shop_id' => '2',
			'primary' => 1,
			'always_redirect_here' => 0,
			'shop_web_address' => 1
		),
	);
}
