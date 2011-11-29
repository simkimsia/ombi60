<?php
/* Aco Fixture generated on: 2011-11-29 06:41:10 : 1322548870 */

/**
 * AcoFixture
 *
 */
class AcoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => NULL, 'comment' => ''),
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
			'parent_id' => NULL,
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'controllers',
			'lft' => '1',
			'rght' => '530'
		),
		array(
			'id' => '2',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Pages',
			'lft' => '2',
			'rght' => '9'
		),
		array(
			'id' => '3',
			'parent_id' => '2',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'display',
			'lft' => '3',
			'rght' => '4'
		),
		array(
			'id' => '4',
			'parent_id' => '2',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '5',
			'rght' => '6'
		),
		array(
			'id' => '5',
			'parent_id' => '2',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '7',
			'rght' => '8'
		),
		array(
			'id' => '6',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Payments',
			'lft' => '10',
			'rght' => '29'
		),
		array(
			'id' => '7',
			'parent_id' => '6',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '11',
			'rght' => '12'
		),
		array(
			'id' => '8',
			'parent_id' => '6',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_update_settings',
			'lft' => '13',
			'rght' => '14'
		),
		array(
			'id' => '9',
			'parent_id' => '6',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add_paypal_payment',
			'lft' => '15',
			'rght' => '16'
		),
		array(
			'id' => '10',
			'parent_id' => '6',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add_custom_payment',
			'lft' => '17',
			'rght' => '18'
		),
		array(
			'id' => '11',
			'parent_id' => '6',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit_paypal_payment',
			'lft' => '19',
			'rght' => '20'
		),
		array(
			'id' => '12',
			'parent_id' => '6',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit_custom_payment',
			'lft' => '21',
			'rght' => '22'
		),
		array(
			'id' => '13',
			'parent_id' => '6',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete_custom_payment',
			'lft' => '23',
			'rght' => '24'
		),
		array(
			'id' => '14',
			'parent_id' => '6',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '25',
			'rght' => '26'
		),
		array(
			'id' => '15',
			'parent_id' => '6',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '27',
			'rght' => '28'
		),
		array(
			'id' => '16',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'ShippingRates',
			'lft' => '30',
			'rght' => '45'
		),
		array(
			'id' => '17',
			'parent_id' => '16',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '31',
			'rght' => '32'
		),
		array(
			'id' => '18',
			'parent_id' => '16',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit',
			'lft' => '33',
			'rght' => '34'
		),
		array(
			'id' => '19',
			'parent_id' => '16',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add_price_based',
			'lft' => '35',
			'rght' => '36'
		),
		array(
			'id' => '20',
			'parent_id' => '16',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add_weight_based',
			'lft' => '37',
			'rght' => '38'
		),
		array(
			'id' => '21',
			'parent_id' => '16',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete',
			'lft' => '39',
			'rght' => '40'
		),
		array(
			'id' => '22',
			'parent_id' => '16',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '41',
			'rght' => '42'
		),
		array(
			'id' => '23',
			'parent_id' => '16',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '43',
			'rght' => '44'
		),
		array(
			'id' => '24',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'PaydollarTransactions',
			'lft' => '46',
			'rght' => '53'
		),
		array(
			'id' => '25',
			'parent_id' => '24',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'datafeed',
			'lft' => '47',
			'rght' => '48'
		),
		array(
			'id' => '26',
			'parent_id' => '24',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '49',
			'rght' => '50'
		),
		array(
			'id' => '27',
			'parent_id' => '24',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '51',
			'rght' => '52'
		),
		array(
			'id' => '28',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'SavedThemes',
			'lft' => '54',
			'rght' => '81'
		),
		array(
			'id' => '29',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '55',
			'rght' => '56'
		),
		array(
			'id' => '30',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_view',
			'lft' => '57',
			'rght' => '58'
		),
		array(
			'id' => '31',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_switch',
			'lft' => '59',
			'rght' => '60'
		),
		array(
			'id' => '32',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add',
			'lft' => '61',
			'rght' => '62'
		),
		array(
			'id' => '33',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_upload',
			'lft' => '63',
			'rght' => '64'
		),
		array(
			'id' => '34',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit',
			'lft' => '65',
			'rght' => '66'
		),
		array(
			'id' => '35',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete',
			'lft' => '67',
			'rght' => '68'
		),
		array(
			'id' => '36',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit_image',
			'lft' => '69',
			'rght' => '70'
		),
		array(
			'id' => '37',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_feature',
			'lft' => '71',
			'rght' => '72'
		),
		array(
			'id' => '38',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete_image',
			'lft' => '73',
			'rght' => '74'
		),
		array(
			'id' => '39',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit_css',
			'lft' => '75',
			'rght' => '76'
		),
		array(
			'id' => '40',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '77',
			'rght' => '78'
		),
		array(
			'id' => '41',
			'parent_id' => '28',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '79',
			'rght' => '80'
		),
		array(
			'id' => '42',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Addresses',
			'lft' => '82',
			'rght' => '89'
		),
		array(
			'id' => '43',
			'parent_id' => '42',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'index',
			'lft' => '83',
			'rght' => '84'
		),
		array(
			'id' => '44',
			'parent_id' => '42',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '85',
			'rght' => '86'
		),
		array(
			'id' => '45',
			'parent_id' => '42',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '87',
			'rght' => '88'
		),
		array(
			'id' => '46',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'GiftCards',
			'lft' => '90',
			'rght' => '115'
		),
		array(
			'id' => '47',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'index',
			'lft' => '91',
			'rght' => '92'
		),
		array(
			'id' => '48',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'view',
			'lft' => '93',
			'rght' => '94'
		),
		array(
			'id' => '49',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'add',
			'lft' => '95',
			'rght' => '96'
		),
		array(
			'id' => '50',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'edit',
			'lft' => '97',
			'rght' => '98'
		),
		array(
			'id' => '51',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'delete',
			'lft' => '99',
			'rght' => '100'
		),
		array(
			'id' => '52',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '101',
			'rght' => '102'
		),
		array(
			'id' => '53',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_view',
			'lft' => '103',
			'rght' => '104'
		),
		array(
			'id' => '54',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add',
			'lft' => '105',
			'rght' => '106'
		),
		array(
			'id' => '55',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit',
			'lft' => '107',
			'rght' => '108'
		),
		array(
			'id' => '56',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete',
			'lft' => '109',
			'rght' => '110'
		),
		array(
			'id' => '57',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '111',
			'rght' => '112'
		),
		array(
			'id' => '58',
			'parent_id' => '46',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '113',
			'rght' => '114'
		),
		array(
			'id' => '59',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Products',
			'lft' => '116',
			'rght' => '173'
		),
		array(
			'id' => '60',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'checkout',
			'lft' => '117',
			'rght' => '118'
		),
		array(
			'id' => '61',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'change_qty_for_1_item_in_cart',
			'lft' => '119',
			'rght' => '120'
		),
		array(
			'id' => '62',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'view_cart',
			'lft' => '121',
			'rght' => '122'
		),
		array(
			'id' => '63',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '123',
			'rght' => '124'
		),
		array(
			'id' => '64',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_view',
			'lft' => '125',
			'rght' => '126'
		),
		array(
			'id' => '65',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'view',
			'lft' => '127',
			'rght' => '128'
		),
		array(
			'id' => '66',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'view_by_group',
			'lft' => '129',
			'rght' => '130'
		),
		array(
			'id' => '67',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add',
			'lft' => '131',
			'rght' => '132'
		),
		array(
			'id' => '68',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_upload',
			'lft' => '133',
			'rght' => '134'
		),
		array(
			'id' => '69',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_toggle',
			'lft' => '135',
			'rght' => '136'
		),
		array(
			'id' => '70',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit',
			'lft' => '137',
			'rght' => '138'
		),
		array(
			'id' => '71',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete',
			'lft' => '139',
			'rght' => '140'
		),
		array(
			'id' => '72',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_duplicate',
			'lft' => '141',
			'rght' => '142'
		),
		array(
			'id' => '73',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_index',
			'lft' => '143',
			'rght' => '144'
		),
		array(
			'id' => '74',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_view',
			'lft' => '145',
			'rght' => '146'
		),
		array(
			'id' => '75',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_add',
			'lft' => '147',
			'rght' => '148'
		),
		array(
			'id' => '76',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_edit',
			'lft' => '149',
			'rght' => '150'
		),
		array(
			'id' => '77',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_delete',
			'lft' => '151',
			'rght' => '152'
		),
		array(
			'id' => '78',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'add_to_cart',
			'lft' => '153',
			'rght' => '154'
		),
		array(
			'id' => '79',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'delete_from_cart',
			'lft' => '155',
			'rght' => '156'
		),
		array(
			'id' => '80',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_search',
			'lft' => '157',
			'rght' => '158'
		),
		array(
			'id' => '81',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_remove_variant_option',
			'lft' => '159',
			'rght' => '160'
		),
		array(
			'id' => '82',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '161',
			'rght' => '162'
		),
		array(
			'id' => '83',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '163',
			'rght' => '164'
		),
		array(
			'id' => '84',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Domains',
			'lft' => '174',
			'rght' => '191'
		),
		array(
			'id' => '85',
			'parent_id' => '84',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '175',
			'rght' => '176'
		),
		array(
			'id' => '86',
			'parent_id' => '84',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_view',
			'lft' => '177',
			'rght' => '178'
		),
		array(
			'id' => '87',
			'parent_id' => '84',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add',
			'lft' => '179',
			'rght' => '180'
		),
		array(
			'id' => '88',
			'parent_id' => '84',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_make_this_primary',
			'lft' => '181',
			'rght' => '182'
		),
		array(
			'id' => '89',
			'parent_id' => '84',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit',
			'lft' => '183',
			'rght' => '184'
		),
		array(
			'id' => '90',
			'parent_id' => '84',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete',
			'lft' => '185',
			'rght' => '186'
		),
		array(
			'id' => '91',
			'parent_id' => '84',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '187',
			'rght' => '188'
		),
		array(
			'id' => '92',
			'parent_id' => '84',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '189',
			'rght' => '190'
		),
		array(
			'id' => '93',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Shops',
			'lft' => '192',
			'rght' => '203'
		),
		array(
			'id' => '94',
			'parent_id' => '93',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_general_settings',
			'lft' => '193',
			'rght' => '194'
		),
		array(
			'id' => '95',
			'parent_id' => '93',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_account',
			'lft' => '195',
			'rght' => '196'
		),
		array(
			'id' => '96',
			'parent_id' => '93',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_cancelaccount',
			'lft' => '197',
			'rght' => '198'
		),
		array(
			'id' => '97',
			'parent_id' => '93',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '199',
			'rght' => '200'
		),
		array(
			'id' => '98',
			'parent_id' => '93',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '201',
			'rght' => '202'
		),
		array(
			'id' => '99',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Customers',
			'lft' => '204',
			'rght' => '215'
		),
		array(
			'id' => '100',
			'parent_id' => '99',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'register',
			'lft' => '205',
			'rght' => '206'
		),
		array(
			'id' => '101',
			'parent_id' => '99',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'login',
			'lft' => '207',
			'rght' => '208'
		),
		array(
			'id' => '102',
			'parent_id' => '99',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'logout',
			'lft' => '209',
			'rght' => '210'
		),
		array(
			'id' => '103',
			'parent_id' => '99',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '211',
			'rght' => '212'
		),
		array(
			'id' => '104',
			'parent_id' => '99',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '213',
			'rght' => '214'
		),
		array(
			'id' => '105',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Links',
			'lft' => '216',
			'rght' => '229'
		),
		array(
			'id' => '111',
			'parent_id' => '105',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '217',
			'rght' => '218'
		),
		array(
			'id' => '112',
			'parent_id' => '105',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_order',
			'lft' => '219',
			'rght' => '220'
		),
		array(
			'id' => '113',
			'parent_id' => '105',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add',
			'lft' => '221',
			'rght' => '222'
		),
		array(
			'id' => '115',
			'parent_id' => '105',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete',
			'lft' => '223',
			'rght' => '224'
		),
		array(
			'id' => '116',
			'parent_id' => '105',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '225',
			'rght' => '226'
		),
		array(
			'id' => '117',
			'parent_id' => '105',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '227',
			'rght' => '228'
		),
		array(
			'id' => '118',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Groups',
			'lft' => '230',
			'rght' => '237'
		),
		array(
			'id' => '119',
			'parent_id' => '118',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'parentNode',
			'lft' => '231',
			'rght' => '232'
		),
		array(
			'id' => '120',
			'parent_id' => '118',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '233',
			'rght' => '234'
		),
		array(
			'id' => '121',
			'parent_id' => '118',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '235',
			'rght' => '236'
		),
		array(
			'id' => '122',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Blogs',
			'lft' => '238',
			'rght' => '253'
		),
		array(
			'id' => '123',
			'parent_id' => '122',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '239',
			'rght' => '240'
		),
		array(
			'id' => '124',
			'parent_id' => '122',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_view',
			'lft' => '241',
			'rght' => '242'
		),
		array(
			'id' => '125',
			'parent_id' => '122',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add',
			'lft' => '243',
			'rght' => '244'
		),
		array(
			'id' => '126',
			'parent_id' => '122',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit',
			'lft' => '245',
			'rght' => '246'
		),
		array(
			'id' => '127',
			'parent_id' => '122',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete',
			'lft' => '247',
			'rght' => '248'
		),
		array(
			'id' => '128',
			'parent_id' => '122',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '249',
			'rght' => '250'
		),
		array(
			'id' => '129',
			'parent_id' => '122',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '251',
			'rght' => '252'
		),
		array(
			'id' => '130',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'ProductGroups',
			'lft' => '254',
			'rght' => '285'
		),
		array(
			'id' => '131',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '255',
			'rght' => '256'
		),
		array(
			'id' => '132',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_view_smart',
			'lft' => '257',
			'rght' => '258'
		),
		array(
			'id' => '133',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add_smart',
			'lft' => '259',
			'rght' => '260'
		),
		array(
			'id' => '134',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit_smart',
			'lft' => '261',
			'rght' => '262'
		),
		array(
			'id' => '135',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_view_custom',
			'lft' => '263',
			'rght' => '264'
		),
		array(
			'id' => '136',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add_custom',
			'lft' => '265',
			'rght' => '266'
		),
		array(
			'id' => '137',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add_product_in_group',
			'lft' => '267',
			'rght' => '268'
		),
		array(
			'id' => '138',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_remove_product_from_group',
			'lft' => '269',
			'rght' => '270'
		),
		array(
			'id' => '139',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit_custom',
			'lft' => '271',
			'rght' => '272'
		),
		array(
			'id' => '140',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete',
			'lft' => '273',
			'rght' => '274'
		),
		array(
			'id' => '141',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_toggle',
			'lft' => '275',
			'rght' => '276'
		),
		array(
			'id' => '142',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_remove_condition',
			'lft' => '277',
			'rght' => '278'
		),
		array(
			'id' => '143',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_save_condition',
			'lft' => '279',
			'rght' => '280'
		),
		array(
			'id' => '144',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '281',
			'rght' => '282'
		),
		array(
			'id' => '145',
			'parent_id' => '130',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '283',
			'rght' => '284'
		),
		array(
			'id' => '146',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'ProductImages',
			'lft' => '286',
			'rght' => '307'
		),
		array(
			'id' => '147',
			'parent_id' => '146',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add',
			'lft' => '287',
			'rght' => '288'
		),
		array(
			'id' => '148',
			'parent_id' => '146',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add_by_product',
			'lft' => '289',
			'rght' => '290'
		),
		array(
			'id' => '149',
			'parent_id' => '146',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_uploadify',
			'lft' => '291',
			'rght' => '292'
		),
		array(
			'id' => '150',
			'parent_id' => '146',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_list_by_product',
			'lft' => '293',
			'rght' => '294'
		),
		array(
			'id' => '151',
			'parent_id' => '146',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete',
			'lft' => '295',
			'rght' => '296'
		),
		array(
			'id' => '152',
			'parent_id' => '146',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_make_this_cover',
			'lft' => '297',
			'rght' => '298'
		),
		array(
			'id' => '153',
			'parent_id' => '146',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_ajax_product_image_upload',
			'lft' => '299',
			'rght' => '300'
		),
		array(
			'id' => '154',
			'parent_id' => '146',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete_me',
			'lft' => '301',
			'rght' => '302'
		),
		array(
			'id' => '155',
			'parent_id' => '146',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '303',
			'rght' => '304'
		),
		array(
			'id' => '156',
			'parent_id' => '146',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '305',
			'rght' => '306'
		),
		array(
			'id' => '157',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Carts',
			'lft' => '308',
			'rght' => '321'
		),
		array(
			'id' => '158',
			'parent_id' => '157',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'index',
			'lft' => '309',
			'rght' => '310'
		),
		array(
			'id' => '159',
			'parent_id' => '157',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'view',
			'lft' => '311',
			'rght' => '312'
		),
		array(
			'id' => '160',
			'parent_id' => '157',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'edit',
			'lft' => '313',
			'rght' => '314'
		),
		array(
			'id' => '161',
			'parent_id' => '157',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'delete',
			'lft' => '315',
			'rght' => '316'
		),
		array(
			'id' => '162',
			'parent_id' => '157',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '317',
			'rght' => '318'
		),
		array(
			'id' => '163',
			'parent_id' => '157',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '319',
			'rght' => '320'
		),
		array(
			'id' => '164',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Orders',
			'lft' => '322',
			'rght' => '347'
		),
		array(
			'id' => '165',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'paypal',
			'lft' => '323',
			'rght' => '324'
		),
		array(
			'id' => '166',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'index',
			'lft' => '325',
			'rght' => '326'
		),
		array(
			'id' => '167',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '327',
			'rght' => '328'
		),
		array(
			'id' => '168',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_view',
			'lft' => '329',
			'rght' => '330'
		),
		array(
			'id' => '169',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'view',
			'lft' => '331',
			'rght' => '332'
		),
		array(
			'id' => '170',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'add',
			'lft' => '333',
			'rght' => '334'
		),
		array(
			'id' => '171',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'checkout',
			'lft' => '335',
			'rght' => '336'
		),
		array(
			'id' => '172',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'success',
			'lft' => '337',
			'rght' => '338'
		),
		array(
			'id' => '173',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'updatePrices',
			'lft' => '339',
			'rght' => '340'
		),
		array(
			'id' => '174',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'pay',
			'lft' => '341',
			'rght' => '342'
		),
		array(
			'id' => '175',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '343',
			'rght' => '344'
		),
		array(
			'id' => '176',
			'parent_id' => '164',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '345',
			'rght' => '346'
		),
		array(
			'id' => '177',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Merchants',
			'lft' => '348',
			'rght' => '371'
		),
		array(
			'id' => '178',
			'parent_id' => '177',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'register',
			'lft' => '349',
			'rght' => '350'
		),
		array(
			'id' => '179',
			'parent_id' => '177',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_login',
			'lft' => '351',
			'rght' => '352'
		),
		array(
			'id' => '180',
			'parent_id' => '177',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_logout',
			'lft' => '353',
			'rght' => '354'
		),
		array(
			'id' => '181',
			'parent_id' => '177',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '355',
			'rght' => '356'
		),
		array(
			'id' => '182',
			'parent_id' => '177',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit',
			'lft' => '357',
			'rght' => '358'
		),
		array(
			'id' => '183',
			'parent_id' => '177',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_index',
			'lft' => '359',
			'rght' => '360'
		),
		array(
			'id' => '184',
			'parent_id' => '177',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_view',
			'lft' => '361',
			'rght' => '362'
		),
		array(
			'id' => '185',
			'parent_id' => '177',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_edit',
			'lft' => '363',
			'rght' => '364'
		),
		array(
			'id' => '186',
			'parent_id' => '177',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_delete',
			'lft' => '365',
			'rght' => '366'
		),
		array(
			'id' => '187',
			'parent_id' => '177',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '367',
			'rght' => '368'
		),
		array(
			'id' => '188',
			'parent_id' => '177',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '369',
			'rght' => '370'
		),
		array(
			'id' => '189',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Themes',
			'lft' => '372',
			'rght' => '381'
		),
		array(
			'id' => '190',
			'parent_id' => '189',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '373',
			'rght' => '374'
		),
		array(
			'id' => '191',
			'parent_id' => '189',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '375',
			'rght' => '376'
		),
		array(
			'id' => '192',
			'parent_id' => '189',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '377',
			'rght' => '378'
		),
		array(
			'id' => '193',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Webpages',
			'lft' => '382',
			'rght' => '405'
		),
		array(
			'id' => '194',
			'parent_id' => '193',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'view',
			'lft' => '383',
			'rght' => '384'
		),
		array(
			'id' => '195',
			'parent_id' => '193',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'frontpage',
			'lft' => '385',
			'rght' => '386'
		),
		array(
			'id' => '196',
			'parent_id' => '193',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_index',
			'lft' => '387',
			'rght' => '388'
		),
		array(
			'id' => '197',
			'parent_id' => '193',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_view',
			'lft' => '389',
			'rght' => '390'
		),
		array(
			'id' => '198',
			'parent_id' => '193',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_toggle',
			'lft' => '391',
			'rght' => '392'
		),
		array(
			'id' => '199',
			'parent_id' => '193',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add',
			'lft' => '393',
			'rght' => '394'
		),
		array(
			'id' => '200',
			'parent_id' => '193',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit',
			'lft' => '395',
			'rght' => '396'
		),
		array(
			'id' => '201',
			'parent_id' => '193',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete',
			'lft' => '397',
			'rght' => '398'
		),
		array(
			'id' => '202',
			'parent_id' => '193',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '399',
			'rght' => '400'
		),
		array(
			'id' => '203',
			'parent_id' => '193',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '401',
			'rght' => '402'
		),
		array(
			'id' => '204',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Users',
			'lft' => '406',
			'rght' => '427'
		),
		array(
			'id' => '205',
			'parent_id' => '204',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'parentNode',
			'lft' => '407',
			'rght' => '408'
		),
		array(
			'id' => '206',
			'parent_id' => '204',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'initDB',
			'lft' => '409',
			'rght' => '410'
		),
		array(
			'id' => '207',
			'parent_id' => '204',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'login',
			'lft' => '411',
			'rght' => '412'
		),
		array(
			'id' => '208',
			'parent_id' => '204',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'logout',
			'lft' => '413',
			'rght' => '414'
		),
		array(
			'id' => '209',
			'parent_id' => '204',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_login',
			'lft' => '415',
			'rght' => '416'
		),
		array(
			'id' => '210',
			'parent_id' => '204',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_logout',
			'lft' => '417',
			'rght' => '418'
		),
		array(
			'id' => '211',
			'parent_id' => '204',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'platform_index',
			'lft' => '419',
			'rght' => '420'
		),
		array(
			'id' => '212',
			'parent_id' => '204',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'afterSave',
			'lft' => '421',
			'rght' => '422'
		),
		array(
			'id' => '213',
			'parent_id' => '204',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '423',
			'rght' => '424'
		),
		array(
			'id' => '214',
			'parent_id' => '204',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '425',
			'rght' => '426'
		),
		array(
			'id' => '215',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Posts',
			'lft' => '428',
			'rght' => '447'
		),
		array(
			'id' => '216',
			'parent_id' => '215',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'view',
			'lft' => '429',
			'rght' => '430'
		),
		array(
			'id' => '217',
			'parent_id' => '215',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'index',
			'lft' => '431',
			'rght' => '432'
		),
		array(
			'id' => '218',
			'parent_id' => '215',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_view',
			'lft' => '433',
			'rght' => '434'
		),
		array(
			'id' => '219',
			'parent_id' => '215',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add',
			'lft' => '435',
			'rght' => '436'
		),
		array(
			'id' => '220',
			'parent_id' => '215',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit',
			'lft' => '437',
			'rght' => '438'
		),
		array(
			'id' => '221',
			'parent_id' => '215',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete',
			'lft' => '439',
			'rght' => '440'
		),
		array(
			'id' => '222',
			'parent_id' => '215',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_toggle',
			'lft' => '441',
			'rght' => '442'
		),
		array(
			'id' => '223',
			'parent_id' => '215',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '443',
			'rght' => '444'
		),
		array(
			'id' => '224',
			'parent_id' => '215',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '445',
			'rght' => '446'
		),
		array(
			'id' => '225',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Linkable',
			'lft' => '448',
			'rght' => '449'
		),
		array(
			'id' => '226',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'ThemeFolder',
			'lft' => '450',
			'rght' => '451'
		),
		array(
			'id' => '227',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Paypal',
			'lft' => '452',
			'rght' => '453'
		),
		array(
			'id' => '228',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Rest',
			'lft' => '454',
			'rght' => '455'
		),
		array(
			'id' => '229',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'TwigView',
			'lft' => '456',
			'rght' => '457'
		),
		array(
			'id' => '230',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Visible',
			'lft' => '458',
			'rght' => '459'
		),
		array(
			'id' => '231',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'RandomString',
			'lft' => '460',
			'rght' => '461'
		),
		array(
			'id' => '232',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Paydollar',
			'lft' => '462',
			'rght' => '463'
		),
		array(
			'id' => '233',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'DebugKit',
			'lft' => '464',
			'rght' => '475'
		),
		array(
			'id' => '234',
			'parent_id' => '233',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'ToolbarAccess',
			'lft' => '465',
			'rght' => '474'
		),
		array(
			'id' => '235',
			'parent_id' => '234',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'history_state',
			'lft' => '466',
			'rght' => '467'
		),
		array(
			'id' => '236',
			'parent_id' => '234',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'sql_explain',
			'lft' => '468',
			'rght' => '469'
		),
		array(
			'id' => '237',
			'parent_id' => '234',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '470',
			'rght' => '471'
		),
		array(
			'id' => '238',
			'parent_id' => '234',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '472',
			'rght' => '473'
		),
		array(
			'id' => '239',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'AclExtras',
			'lft' => '476',
			'rght' => '477'
		),
		array(
			'id' => '240',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Filter',
			'lft' => '478',
			'rght' => '479'
		),
		array(
			'id' => '241',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'ClearCache',
			'lft' => '480',
			'rght' => '481'
		),
		array(
			'id' => '242',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Handleize',
			'lft' => '482',
			'rght' => '483'
		),
		array(
			'id' => '243',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Datasources',
			'lft' => '484',
			'rght' => '485'
		),
		array(
			'id' => '244',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'TinyMce',
			'lft' => '486',
			'rght' => '487'
		),
		array(
			'id' => '245',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Uploadify',
			'lft' => '488',
			'rght' => '489'
		),
		array(
			'id' => '246',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Recaptcha',
			'lft' => '490',
			'rght' => '491'
		),
		array(
			'id' => '247',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Copyable',
			'lft' => '492',
			'rght' => '493'
		),
		array(
			'id' => '248',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'MeioUpload',
			'lft' => '494',
			'rght' => '495'
		),
		array(
			'id' => '249',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Log',
			'lft' => '496',
			'rght' => '505'
		),
		array(
			'id' => '250',
			'parent_id' => '249',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'Logs',
			'lft' => '497',
			'rght' => '504'
		),
		array(
			'id' => '251',
			'parent_id' => '250',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'index',
			'lft' => '498',
			'rght' => '499'
		),
		array(
			'id' => '252',
			'parent_id' => '250',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '500',
			'rght' => '501'
		),
		array(
			'id' => '253',
			'parent_id' => '250',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '502',
			'rght' => '503'
		),
		array(
			'id' => '254',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'CodeCheck',
			'lft' => '506',
			'rght' => '507'
		),
		array(
			'id' => '255',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'TimeZone',
			'lft' => '508',
			'rght' => '509'
		),
		array(
			'id' => '256',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'MeioDuplicate',
			'lft' => '510',
			'rght' => '511'
		),
		array(
			'id' => '257',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_add_variant',
			'lft' => '165',
			'rght' => '166'
		),
		array(
			'id' => '258',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit_variant',
			'lft' => '167',
			'rght' => '168'
		),
		array(
			'id' => '259',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_delete_variant',
			'lft' => '169',
			'rght' => '170'
		),
		array(
			'id' => '260',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'ManyToManyCountable',
			'lft' => '512',
			'rght' => '513'
		),
		array(
			'id' => '261',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'LinkLists',
			'lft' => '514',
			'rght' => '521'
		),
		array(
			'id' => '262',
			'parent_id' => '261',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_edit',
			'lft' => '515',
			'rght' => '516'
		),
		array(
			'id' => '263',
			'parent_id' => '261',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '517',
			'rght' => '518'
		),
		array(
			'id' => '264',
			'parent_id' => '261',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '519',
			'rght' => '520'
		),
		array(
			'id' => '265',
			'parent_id' => '189',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_settings',
			'lft' => '379',
			'rght' => '380'
		),
		array(
			'id' => '266',
			'parent_id' => '193',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_menu_action',
			'lft' => '403',
			'rght' => '404'
		),
		array(
			'id' => '267',
			'parent_id' => '59',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_menu_action',
			'lft' => '171',
			'rght' => '172'
		),
		array(
			'id' => '268',
			'parent_id' => '1',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'RedirectFiles',
			'lft' => '522',
			'rght' => '529'
		),
		array(
			'id' => '269',
			'parent_id' => '268',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'theme',
			'lft' => '523',
			'rght' => '524'
		),
		array(
			'id' => '270',
			'parent_id' => '268',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'forceSSL',
			'lft' => '525',
			'rght' => '526'
		),
		array(
			'id' => '271',
			'parent_id' => '268',
			'model' => NULL,
			'foreign_key' => NULL,
			'alias' => 'admin_change_active_status',
			'lft' => '527',
			'rght' => '528'
		),
	);
}
