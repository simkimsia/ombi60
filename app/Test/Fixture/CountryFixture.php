<?php
/* Country Fixture generated on: 2011-10-05 06:19:21 : 1317795561 */

/**
 * CountryFixture
 *
 */
class CountryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'iso' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 80, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'printable_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 80, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'iso3' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 3, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'numcode' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 6, 'collate' => NULL, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'unique_iso' => array('column' => 'iso', 'unique' => 1), 'unique_name' => array('column' => 'name', 'unique' => 1), 'unique_printable_name' => array('column' => 'printable_name', 'unique' => 1), 'unique_iso3' => array('column' => 'iso3', 'unique' => 1)),
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
			'iso' => 'AF',
			'name' => 'AFGHANISTAN',
			'printable_name' => 'Afghanistan',
			'iso3' => 'AFG',
			'numcode' => '4'
		),
		array(
			'id' => '2',
			'iso' => 'AL',
			'name' => 'ALBANIA',
			'printable_name' => 'Albania',
			'iso3' => 'ALB',
			'numcode' => '8'
		),
		array(
			'id' => '3',
			'iso' => 'DZ',
			'name' => 'ALGERIA',
			'printable_name' => 'Algeria',
			'iso3' => 'DZA',
			'numcode' => '12'
		),
		array(
			'id' => '4',
			'iso' => 'AS',
			'name' => 'AMERICAN SAMOA',
			'printable_name' => 'American Samoa',
			'iso3' => 'ASM',
			'numcode' => '16'
		),
		array(
			'id' => '5',
			'iso' => 'AD',
			'name' => 'ANDORRA',
			'printable_name' => 'Andorra',
			'iso3' => 'AND',
			'numcode' => '20'
		),
		array(
			'id' => '6',
			'iso' => 'AO',
			'name' => 'ANGOLA',
			'printable_name' => 'Angola',
			'iso3' => 'AGO',
			'numcode' => '24'
		),
		array(
			'id' => '7',
			'iso' => 'AI',
			'name' => 'ANGUILLA',
			'printable_name' => 'Anguilla',
			'iso3' => 'AIA',
			'numcode' => '660'
		),
		array(
			'id' => '8',
			'iso' => 'AQ',
			'name' => 'ANTARCTICA',
			'printable_name' => 'Antarctica',
			'iso3' => NULL,
			'numcode' => NULL
		),
		array(
			'id' => '9',
			'iso' => 'AG',
			'name' => 'ANTIGUA AND BARBUDA',
			'printable_name' => 'Antigua and Barbuda',
			'iso3' => 'ATG',
			'numcode' => '28'
		),
		array(
			'id' => '10',
			'iso' => 'AR',
			'name' => 'ARGENTINA',
			'printable_name' => 'Argentina',
			'iso3' => 'ARG',
			'numcode' => '32'
		),
	);
}
