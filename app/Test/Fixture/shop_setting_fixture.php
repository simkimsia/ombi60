<?php
/* ShopSetting Fixture generated on: 2011-03-28 05:03:54 : 1301291454 */
class ShopSettingFixture extends CakeTestFixture {
	var $name = 'ShopSetting';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'shop_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'timezone' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'unit_system' => array('type' => 'string', 'null' => true, 'default' => 'metric', 'length' => 50),
		'currency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'money_in_html_with_currency' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'money_in_html' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'money_in_email_with_currency' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'money_in_email' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'checkout_language' => array('type' => 'integer', 'null' => true, 'default' => '1', 'length' => 3),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'shop_id' => 1,
			'timezone' => 'Lorem ipsum dolor sit amet',
			'unit_system' => 'Lorem ipsum dolor sit amet',
			'currency' => 'Lorem ipsum dolor sit amet',
			'money_in_html_with_currency' => 'Lorem ipsum dolor sit amet',
			'money_in_html' => 'Lorem ipsum dolor sit amet',
			'money_in_email_with_currency' => 'Lorem ipsum dolor sit amet',
			'money_in_email' => 'Lorem ipsum dolor sit amet',
			'checkout_language' => 1
		),
	);
}
?>