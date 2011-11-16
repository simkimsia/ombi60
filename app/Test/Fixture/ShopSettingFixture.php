<?php
/* ShopSetting Fixture generated on: 2011-09-28 10:25:09 : 1317205509 */

/**
 * ShopSettingFixture
 *
 */
class ShopSettingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'timezone' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'unit_system' => array('type' => 'string', 'null' => true, 'default' => 'metric', 'length' => 50, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'currency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'money_in_html_with_currency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'money_in_html' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'money_in_email_with_currency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'money_in_email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'checkout_language' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 3, 'collate' => NULL, 'comment' => ''),
		'users_accepted' => array('type' => 'string', 'null' => false, 'default' => 'guest', 'length' => 10, 'collate' => NULL, 'comment' => ''),
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
			'shop_id' => '2',
			'timezone' => 'Asia/Singapore',
			'unit_system' => 'metric',
			'currency' => 'SGD',
			'money_in_html_with_currency' => '${{amount}}',
			'money_in_html' => '{{amount}}',
			'money_in_email_with_currency' => '${{amount}}',
			'money_in_email' => '{{amount}}',
			'checkout_language' => '1',
			'users_accepted' => 'guest'
		),
	);
}
