<?php
/* Aro Fixture generated on: 2011-11-29 06:41:23 : 1322548883 */

/**
 * AroFixture
 *
 */
class AroFixture extends CakeTestFixture {

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
			'model' => 'Group',
			'foreign_key' => '1',
			'alias' => 'administrators',
			'lft' => '1',
			'rght' => '2'
		),
		array(
			'id' => '2',
			'parent_id' => NULL,
			'model' => 'Group',
			'foreign_key' => '2',
			'alias' => 'editors',
			'lft' => '3',
			'rght' => '4'
		),
		array(
			'id' => '3',
			'parent_id' => NULL,
			'model' => 'Group',
			'foreign_key' => '3',
			'alias' => 'merchants',
			'lft' => '5',
			'rght' => '8'
		),
		array(
			'id' => '4',
			'parent_id' => NULL,
			'model' => 'Group',
			'foreign_key' => '4',
			'alias' => 'customers',
			'lft' => '9',
			'rght' => '548'
		),
		array(
			'id' => '5',
			'parent_id' => NULL,
			'model' => 'Group',
			'foreign_key' => '5',
			'alias' => 'casual',
			'lft' => '549',
			'rght' => '968'
		),
		array(
			'id' => '6',
			'parent_id' => '3',
			'model' => 'User',
			'foreign_key' => '1',
			'alias' => NULL,
			'lft' => '6',
			'rght' => '7'
		),
		array(
			'id' => '7',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '2',
			'alias' => NULL,
			'lft' => '973',
			'rght' => '974'
		),
		array(
			'id' => '8',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '550',
			'rght' => '551'
		),
		array(
			'id' => '9',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '969',
			'rght' => '970'
		),
		array(
			'id' => '10',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '971',
			'rght' => '972'
		),
		array(
			'id' => '11',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '552',
			'rght' => '553'
		),
		array(
			'id' => '12',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '554',
			'rght' => '555'
		),
		array(
			'id' => '13',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '556',
			'rght' => '557'
		),
		array(
			'id' => '14',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '558',
			'rght' => '559'
		),
		array(
			'id' => '15',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '560',
			'rght' => '561'
		),
		array(
			'id' => '16',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '562',
			'rght' => '563'
		),
		array(
			'id' => '17',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '564',
			'rght' => '565'
		),
		array(
			'id' => '18',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '566',
			'rght' => '567'
		),
		array(
			'id' => '19',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '568',
			'rght' => '569'
		),
		array(
			'id' => '20',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '570',
			'rght' => '571'
		),
		array(
			'id' => '21',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '572',
			'rght' => '573'
		),
		array(
			'id' => '22',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '574',
			'rght' => '575'
		),
		array(
			'id' => '23',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '576',
			'rght' => '577'
		),
		array(
			'id' => '24',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '578',
			'rght' => '579'
		),
		array(
			'id' => '25',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '580',
			'rght' => '581'
		),
		array(
			'id' => '26',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '582',
			'rght' => '583'
		),
		array(
			'id' => '27',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '584',
			'rght' => '585'
		),
		array(
			'id' => '28',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '586',
			'rght' => '587'
		),
		array(
			'id' => '29',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '588',
			'rght' => '589'
		),
		array(
			'id' => '30',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '590',
			'rght' => '591'
		),
		array(
			'id' => '31',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '592',
			'rght' => '593'
		),
		array(
			'id' => '32',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '594',
			'rght' => '595'
		),
		array(
			'id' => '33',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '596',
			'rght' => '597'
		),
		array(
			'id' => '34',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '598',
			'rght' => '599'
		),
		array(
			'id' => '35',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '600',
			'rght' => '601'
		),
		array(
			'id' => '36',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '602',
			'rght' => '603'
		),
		array(
			'id' => '37',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '604',
			'rght' => '605'
		),
		array(
			'id' => '38',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '606',
			'rght' => '607'
		),
		array(
			'id' => '39',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '608',
			'rght' => '609'
		),
		array(
			'id' => '40',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '610',
			'rght' => '611'
		),
		array(
			'id' => '41',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '612',
			'rght' => '613'
		),
		array(
			'id' => '42',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '614',
			'rght' => '615'
		),
		array(
			'id' => '43',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '616',
			'rght' => '617'
		),
		array(
			'id' => '44',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '618',
			'rght' => '619'
		),
		array(
			'id' => '45',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '620',
			'rght' => '621'
		),
		array(
			'id' => '46',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '622',
			'rght' => '623'
		),
		array(
			'id' => '47',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '624',
			'rght' => '625'
		),
		array(
			'id' => '48',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '626',
			'rght' => '627'
		),
		array(
			'id' => '49',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '628',
			'rght' => '629'
		),
		array(
			'id' => '50',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '630',
			'rght' => '631'
		),
		array(
			'id' => '51',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '632',
			'rght' => '633'
		),
		array(
			'id' => '52',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '634',
			'rght' => '635'
		),
		array(
			'id' => '53',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '636',
			'rght' => '637'
		),
		array(
			'id' => '54',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '638',
			'rght' => '639'
		),
		array(
			'id' => '55',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '640',
			'rght' => '641'
		),
		array(
			'id' => '56',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '642',
			'rght' => '643'
		),
		array(
			'id' => '57',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '644',
			'rght' => '645'
		),
		array(
			'id' => '58',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '646',
			'rght' => '647'
		),
		array(
			'id' => '59',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '648',
			'rght' => '649'
		),
		array(
			'id' => '60',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '650',
			'rght' => '651'
		),
		array(
			'id' => '61',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '652',
			'rght' => '653'
		),
		array(
			'id' => '62',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '654',
			'rght' => '655'
		),
		array(
			'id' => '63',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '656',
			'rght' => '657'
		),
		array(
			'id' => '64',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '658',
			'rght' => '659'
		),
		array(
			'id' => '65',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '660',
			'rght' => '661'
		),
		array(
			'id' => '66',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '662',
			'rght' => '663'
		),
		array(
			'id' => '67',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '664',
			'rght' => '665'
		),
		array(
			'id' => '68',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '666',
			'rght' => '667'
		),
		array(
			'id' => '69',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '668',
			'rght' => '669'
		),
		array(
			'id' => '70',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '670',
			'rght' => '671'
		),
		array(
			'id' => '71',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '672',
			'rght' => '673'
		),
		array(
			'id' => '72',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '674',
			'rght' => '675'
		),
		array(
			'id' => '73',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '676',
			'rght' => '677'
		),
		array(
			'id' => '74',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '678',
			'rght' => '679'
		),
		array(
			'id' => '75',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '680',
			'rght' => '681'
		),
		array(
			'id' => '76',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '682',
			'rght' => '683'
		),
		array(
			'id' => '77',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '684',
			'rght' => '685'
		),
		array(
			'id' => '78',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '686',
			'rght' => '687'
		),
		array(
			'id' => '79',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '688',
			'rght' => '689'
		),
		array(
			'id' => '80',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '690',
			'rght' => '691'
		),
		array(
			'id' => '81',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '692',
			'rght' => '693'
		),
		array(
			'id' => '82',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '694',
			'rght' => '695'
		),
		array(
			'id' => '83',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '696',
			'rght' => '697'
		),
		array(
			'id' => '84',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '698',
			'rght' => '699'
		),
		array(
			'id' => '85',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '700',
			'rght' => '701'
		),
		array(
			'id' => '86',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '702',
			'rght' => '703'
		),
		array(
			'id' => '87',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '704',
			'rght' => '705'
		),
		array(
			'id' => '88',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '706',
			'rght' => '707'
		),
		array(
			'id' => '89',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '708',
			'rght' => '709'
		),
		array(
			'id' => '90',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '710',
			'rght' => '711'
		),
		array(
			'id' => '91',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '712',
			'rght' => '713'
		),
		array(
			'id' => '92',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '714',
			'rght' => '715'
		),
		array(
			'id' => '93',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '716',
			'rght' => '717'
		),
		array(
			'id' => '94',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '718',
			'rght' => '719'
		),
		array(
			'id' => '95',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '720',
			'rght' => '721'
		),
		array(
			'id' => '96',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '722',
			'rght' => '723'
		),
		array(
			'id' => '97',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '724',
			'rght' => '725'
		),
		array(
			'id' => '98',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '726',
			'rght' => '727'
		),
		array(
			'id' => '99',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '728',
			'rght' => '729'
		),
		array(
			'id' => '100',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '730',
			'rght' => '731'
		),
		array(
			'id' => '101',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '732',
			'rght' => '733'
		),
		array(
			'id' => '102',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '734',
			'rght' => '735'
		),
		array(
			'id' => '103',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '736',
			'rght' => '737'
		),
		array(
			'id' => '104',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '738',
			'rght' => '739'
		),
		array(
			'id' => '105',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '740',
			'rght' => '741'
		),
		array(
			'id' => '106',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '742',
			'rght' => '743'
		),
		array(
			'id' => '107',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '744',
			'rght' => '745'
		),
		array(
			'id' => '108',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '746',
			'rght' => '747'
		),
		array(
			'id' => '109',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '748',
			'rght' => '749'
		),
		array(
			'id' => '110',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '750',
			'rght' => '751'
		),
		array(
			'id' => '111',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '5',
			'alias' => NULL,
			'lft' => '975',
			'rght' => '976'
		),
		array(
			'id' => '112',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '6',
			'alias' => NULL,
			'lft' => '752',
			'rght' => '753'
		),
		array(
			'id' => '113',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '754',
			'rght' => '755'
		),
		array(
			'id' => '114',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '756',
			'rght' => '757'
		),
		array(
			'id' => '115',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '5',
			'alias' => NULL,
			'lft' => '758',
			'rght' => '759'
		),
		array(
			'id' => '116',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '6',
			'alias' => NULL,
			'lft' => '760',
			'rght' => '761'
		),
		array(
			'id' => '117',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '10',
			'rght' => '11'
		),
		array(
			'id' => '118',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '12',
			'rght' => '13'
		),
		array(
			'id' => '119',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '14',
			'rght' => '15'
		),
		array(
			'id' => '120',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '16',
			'rght' => '17'
		),
		array(
			'id' => '121',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '18',
			'rght' => '19'
		),
		array(
			'id' => '122',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '20',
			'rght' => '21'
		),
		array(
			'id' => '123',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '22',
			'rght' => '23'
		),
		array(
			'id' => '124',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '24',
			'rght' => '25'
		),
		array(
			'id' => '125',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '26',
			'rght' => '27'
		),
		array(
			'id' => '126',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '28',
			'rght' => '29'
		),
		array(
			'id' => '127',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '30',
			'rght' => '31'
		),
		array(
			'id' => '128',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '32',
			'rght' => '33'
		),
		array(
			'id' => '129',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '34',
			'rght' => '35'
		),
		array(
			'id' => '130',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '36',
			'rght' => '37'
		),
		array(
			'id' => '131',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '38',
			'rght' => '39'
		),
		array(
			'id' => '132',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '40',
			'rght' => '41'
		),
		array(
			'id' => '133',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '42',
			'rght' => '43'
		),
		array(
			'id' => '134',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '44',
			'rght' => '45'
		),
		array(
			'id' => '135',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '46',
			'rght' => '47'
		),
		array(
			'id' => '136',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '48',
			'rght' => '49'
		),
		array(
			'id' => '137',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '50',
			'rght' => '51'
		),
		array(
			'id' => '138',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '52',
			'rght' => '53'
		),
		array(
			'id' => '139',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '54',
			'rght' => '55'
		),
		array(
			'id' => '140',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '56',
			'rght' => '57'
		),
		array(
			'id' => '141',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '58',
			'rght' => '59'
		),
		array(
			'id' => '142',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '60',
			'rght' => '61'
		),
		array(
			'id' => '143',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '62',
			'rght' => '63'
		),
		array(
			'id' => '144',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '64',
			'rght' => '65'
		),
		array(
			'id' => '145',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '66',
			'rght' => '67'
		),
		array(
			'id' => '146',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '68',
			'rght' => '69'
		),
		array(
			'id' => '147',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '70',
			'rght' => '71'
		),
		array(
			'id' => '148',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '72',
			'rght' => '73'
		),
		array(
			'id' => '149',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '74',
			'rght' => '75'
		),
		array(
			'id' => '150',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '76',
			'rght' => '77'
		),
		array(
			'id' => '151',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '78',
			'rght' => '79'
		),
		array(
			'id' => '152',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '80',
			'rght' => '81'
		),
		array(
			'id' => '153',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '82',
			'rght' => '83'
		),
		array(
			'id' => '154',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '84',
			'rght' => '85'
		),
		array(
			'id' => '155',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '86',
			'rght' => '87'
		),
		array(
			'id' => '156',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '88',
			'rght' => '89'
		),
		array(
			'id' => '157',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '90',
			'rght' => '91'
		),
		array(
			'id' => '158',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '92',
			'rght' => '93'
		),
		array(
			'id' => '159',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '94',
			'rght' => '95'
		),
		array(
			'id' => '160',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '96',
			'rght' => '97'
		),
		array(
			'id' => '161',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '98',
			'rght' => '99'
		),
		array(
			'id' => '162',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '3',
			'alias' => NULL,
			'lft' => '100',
			'rght' => '101'
		),
		array(
			'id' => '163',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '102',
			'rght' => '103'
		),
		array(
			'id' => '164',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '104',
			'rght' => '105'
		),
		array(
			'id' => '165',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '106',
			'rght' => '107'
		),
		array(
			'id' => '166',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '108',
			'rght' => '109'
		),
		array(
			'id' => '167',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '110',
			'rght' => '111'
		),
		array(
			'id' => '168',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '112',
			'rght' => '113'
		),
		array(
			'id' => '169',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '114',
			'rght' => '115'
		),
		array(
			'id' => '170',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '116',
			'rght' => '117'
		),
		array(
			'id' => '171',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '118',
			'rght' => '119'
		),
		array(
			'id' => '172',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '120',
			'rght' => '121'
		),
		array(
			'id' => '173',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '122',
			'rght' => '123'
		),
		array(
			'id' => '174',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '124',
			'rght' => '125'
		),
		array(
			'id' => '175',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '126',
			'rght' => '127'
		),
		array(
			'id' => '176',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '128',
			'rght' => '129'
		),
		array(
			'id' => '177',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '130',
			'rght' => '131'
		),
		array(
			'id' => '178',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '132',
			'rght' => '133'
		),
		array(
			'id' => '179',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '134',
			'rght' => '135'
		),
		array(
			'id' => '180',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '136',
			'rght' => '137'
		),
		array(
			'id' => '181',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '138',
			'rght' => '139'
		),
		array(
			'id' => '182',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '140',
			'rght' => '141'
		),
		array(
			'id' => '183',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '142',
			'rght' => '143'
		),
		array(
			'id' => '184',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '762',
			'rght' => '763'
		),
		array(
			'id' => '185',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '764',
			'rght' => '765'
		),
		array(
			'id' => '186',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '766',
			'rght' => '767'
		),
		array(
			'id' => '187',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '144',
			'rght' => '145'
		),
		array(
			'id' => '188',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '146',
			'rght' => '147'
		),
		array(
			'id' => '189',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '148',
			'rght' => '149'
		),
		array(
			'id' => '190',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '150',
			'rght' => '151'
		),
		array(
			'id' => '191',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '152',
			'rght' => '153'
		),
		array(
			'id' => '192',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '154',
			'rght' => '155'
		),
		array(
			'id' => '193',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '156',
			'rght' => '157'
		),
		array(
			'id' => '194',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '158',
			'rght' => '159'
		),
		array(
			'id' => '195',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '160',
			'rght' => '161'
		),
		array(
			'id' => '196',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '768',
			'rght' => '769'
		),
		array(
			'id' => '197',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '162',
			'rght' => '163'
		),
		array(
			'id' => '198',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '164',
			'rght' => '165'
		),
		array(
			'id' => '199',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '166',
			'rght' => '167'
		),
		array(
			'id' => '200',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '168',
			'rght' => '169'
		),
		array(
			'id' => '201',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '170',
			'rght' => '171'
		),
		array(
			'id' => '202',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '172',
			'rght' => '173'
		),
		array(
			'id' => '203',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '174',
			'rght' => '175'
		),
		array(
			'id' => '204',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '176',
			'rght' => '177'
		),
		array(
			'id' => '205',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '178',
			'rght' => '179'
		),
		array(
			'id' => '206',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '180',
			'rght' => '181'
		),
		array(
			'id' => '207',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '182',
			'rght' => '183'
		),
		array(
			'id' => '208',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '184',
			'rght' => '185'
		),
		array(
			'id' => '209',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '186',
			'rght' => '187'
		),
		array(
			'id' => '210',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '188',
			'rght' => '189'
		),
		array(
			'id' => '211',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '190',
			'rght' => '191'
		),
		array(
			'id' => '212',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '192',
			'rght' => '193'
		),
		array(
			'id' => '213',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '194',
			'rght' => '195'
		),
		array(
			'id' => '214',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '196',
			'rght' => '197'
		),
		array(
			'id' => '215',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '198',
			'rght' => '199'
		),
		array(
			'id' => '216',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '200',
			'rght' => '201'
		),
		array(
			'id' => '217',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '202',
			'rght' => '203'
		),
		array(
			'id' => '218',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '204',
			'rght' => '205'
		),
		array(
			'id' => '219',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '206',
			'rght' => '207'
		),
		array(
			'id' => '220',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '208',
			'rght' => '209'
		),
		array(
			'id' => '221',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '210',
			'rght' => '211'
		),
		array(
			'id' => '222',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '212',
			'rght' => '213'
		),
		array(
			'id' => '223',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '214',
			'rght' => '215'
		),
		array(
			'id' => '224',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '216',
			'rght' => '217'
		),
		array(
			'id' => '225',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '218',
			'rght' => '219'
		),
		array(
			'id' => '226',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '220',
			'rght' => '221'
		),
		array(
			'id' => '227',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '222',
			'rght' => '223'
		),
		array(
			'id' => '228',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '224',
			'rght' => '225'
		),
		array(
			'id' => '229',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '226',
			'rght' => '227'
		),
		array(
			'id' => '230',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '228',
			'rght' => '229'
		),
		array(
			'id' => '231',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '230',
			'rght' => '231'
		),
		array(
			'id' => '232',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '232',
			'rght' => '233'
		),
		array(
			'id' => '233',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '234',
			'rght' => '235'
		),
		array(
			'id' => '234',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '236',
			'rght' => '237'
		),
		array(
			'id' => '235',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '238',
			'rght' => '239'
		),
		array(
			'id' => '236',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '240',
			'rght' => '241'
		),
		array(
			'id' => '237',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '242',
			'rght' => '243'
		),
		array(
			'id' => '238',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '244',
			'rght' => '245'
		),
		array(
			'id' => '239',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '246',
			'rght' => '247'
		),
		array(
			'id' => '240',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '248',
			'rght' => '249'
		),
		array(
			'id' => '241',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '250',
			'rght' => '251'
		),
		array(
			'id' => '242',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '252',
			'rght' => '253'
		),
		array(
			'id' => '243',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '254',
			'rght' => '255'
		),
		array(
			'id' => '244',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '256',
			'rght' => '257'
		),
		array(
			'id' => '245',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '258',
			'rght' => '259'
		),
		array(
			'id' => '246',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '260',
			'rght' => '261'
		),
		array(
			'id' => '247',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '262',
			'rght' => '263'
		),
		array(
			'id' => '248',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '264',
			'rght' => '265'
		),
		array(
			'id' => '249',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '266',
			'rght' => '267'
		),
		array(
			'id' => '250',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '770',
			'rght' => '771'
		),
		array(
			'id' => '251',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '268',
			'rght' => '269'
		),
		array(
			'id' => '252',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '270',
			'rght' => '271'
		),
		array(
			'id' => '253',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '272',
			'rght' => '273'
		),
		array(
			'id' => '254',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '274',
			'rght' => '275'
		),
		array(
			'id' => '255',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '5',
			'alias' => NULL,
			'lft' => '772',
			'rght' => '773'
		),
		array(
			'id' => '256',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '6',
			'alias' => NULL,
			'lft' => '977',
			'rght' => '978'
		),
		array(
			'id' => '257',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '774',
			'rght' => '775'
		),
		array(
			'id' => '258',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '276',
			'rght' => '277'
		),
		array(
			'id' => '259',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '278',
			'rght' => '279'
		),
		array(
			'id' => '260',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '280',
			'rght' => '281'
		),
		array(
			'id' => '261',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '776',
			'rght' => '777'
		),
		array(
			'id' => '262',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '282',
			'rght' => '283'
		),
		array(
			'id' => '263',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '284',
			'rght' => '285'
		),
		array(
			'id' => '264',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '286',
			'rght' => '287'
		),
		array(
			'id' => '265',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '778',
			'rght' => '779'
		),
		array(
			'id' => '266',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '288',
			'rght' => '289'
		),
		array(
			'id' => '267',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '290',
			'rght' => '291'
		),
		array(
			'id' => '268',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '292',
			'rght' => '293'
		),
		array(
			'id' => '269',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '780',
			'rght' => '781'
		),
		array(
			'id' => '270',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '294',
			'rght' => '295'
		),
		array(
			'id' => '271',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '296',
			'rght' => '297'
		),
		array(
			'id' => '272',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '298',
			'rght' => '299'
		),
		array(
			'id' => '273',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '782',
			'rght' => '783'
		),
		array(
			'id' => '274',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '300',
			'rght' => '301'
		),
		array(
			'id' => '275',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '302',
			'rght' => '303'
		),
		array(
			'id' => '276',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '304',
			'rght' => '305'
		),
		array(
			'id' => '277',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '784',
			'rght' => '785'
		),
		array(
			'id' => '278',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '306',
			'rght' => '307'
		),
		array(
			'id' => '279',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '308',
			'rght' => '309'
		),
		array(
			'id' => '280',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '310',
			'rght' => '311'
		),
		array(
			'id' => '281',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '786',
			'rght' => '787'
		),
		array(
			'id' => '282',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '312',
			'rght' => '313'
		),
		array(
			'id' => '283',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '314',
			'rght' => '315'
		),
		array(
			'id' => '284',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '316',
			'rght' => '317'
		),
		array(
			'id' => '285',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '788',
			'rght' => '789'
		),
		array(
			'id' => '286',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '318',
			'rght' => '319'
		),
		array(
			'id' => '287',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '320',
			'rght' => '321'
		),
		array(
			'id' => '288',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '322',
			'rght' => '323'
		),
		array(
			'id' => '289',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '790',
			'rght' => '791'
		),
		array(
			'id' => '290',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '324',
			'rght' => '325'
		),
		array(
			'id' => '291',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '326',
			'rght' => '327'
		),
		array(
			'id' => '292',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '328',
			'rght' => '329'
		),
		array(
			'id' => '293',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '792',
			'rght' => '793'
		),
		array(
			'id' => '294',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '330',
			'rght' => '331'
		),
		array(
			'id' => '295',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '332',
			'rght' => '333'
		),
		array(
			'id' => '296',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '334',
			'rght' => '335'
		),
		array(
			'id' => '297',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '794',
			'rght' => '795'
		),
		array(
			'id' => '298',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '336',
			'rght' => '337'
		),
		array(
			'id' => '299',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '338',
			'rght' => '339'
		),
		array(
			'id' => '300',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '340',
			'rght' => '341'
		),
		array(
			'id' => '301',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '796',
			'rght' => '797'
		),
		array(
			'id' => '302',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '342',
			'rght' => '343'
		),
		array(
			'id' => '303',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '344',
			'rght' => '345'
		),
		array(
			'id' => '304',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '346',
			'rght' => '347'
		),
		array(
			'id' => '305',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '798',
			'rght' => '799'
		),
		array(
			'id' => '306',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '348',
			'rght' => '349'
		),
		array(
			'id' => '307',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '350',
			'rght' => '351'
		),
		array(
			'id' => '308',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '352',
			'rght' => '353'
		),
		array(
			'id' => '309',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '800',
			'rght' => '801'
		),
		array(
			'id' => '310',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '354',
			'rght' => '355'
		),
		array(
			'id' => '311',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '356',
			'rght' => '357'
		),
		array(
			'id' => '312',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '358',
			'rght' => '359'
		),
		array(
			'id' => '313',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '802',
			'rght' => '803'
		),
		array(
			'id' => '314',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '360',
			'rght' => '361'
		),
		array(
			'id' => '315',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '362',
			'rght' => '363'
		),
		array(
			'id' => '316',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '364',
			'rght' => '365'
		),
		array(
			'id' => '317',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '804',
			'rght' => '805'
		),
		array(
			'id' => '318',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '366',
			'rght' => '367'
		),
		array(
			'id' => '319',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '368',
			'rght' => '369'
		),
		array(
			'id' => '320',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '370',
			'rght' => '371'
		),
		array(
			'id' => '321',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '806',
			'rght' => '807'
		),
		array(
			'id' => '322',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '372',
			'rght' => '373'
		),
		array(
			'id' => '323',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '374',
			'rght' => '375'
		),
		array(
			'id' => '324',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '376',
			'rght' => '377'
		),
		array(
			'id' => '325',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '808',
			'rght' => '809'
		),
		array(
			'id' => '326',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '378',
			'rght' => '379'
		),
		array(
			'id' => '327',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '380',
			'rght' => '381'
		),
		array(
			'id' => '328',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '382',
			'rght' => '383'
		),
		array(
			'id' => '329',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '810',
			'rght' => '811'
		),
		array(
			'id' => '330',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '384',
			'rght' => '385'
		),
		array(
			'id' => '331',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '386',
			'rght' => '387'
		),
		array(
			'id' => '332',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '388',
			'rght' => '389'
		),
		array(
			'id' => '333',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '812',
			'rght' => '813'
		),
		array(
			'id' => '334',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '390',
			'rght' => '391'
		),
		array(
			'id' => '335',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '392',
			'rght' => '393'
		),
		array(
			'id' => '336',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '394',
			'rght' => '395'
		),
		array(
			'id' => '337',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '814',
			'rght' => '815'
		),
		array(
			'id' => '338',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '396',
			'rght' => '397'
		),
		array(
			'id' => '339',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '398',
			'rght' => '399'
		),
		array(
			'id' => '340',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '400',
			'rght' => '401'
		),
		array(
			'id' => '341',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '816',
			'rght' => '817'
		),
		array(
			'id' => '342',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '402',
			'rght' => '403'
		),
		array(
			'id' => '343',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '404',
			'rght' => '405'
		),
		array(
			'id' => '344',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '406',
			'rght' => '407'
		),
		array(
			'id' => '345',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '818',
			'rght' => '819'
		),
		array(
			'id' => '346',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '408',
			'rght' => '409'
		),
		array(
			'id' => '347',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '410',
			'rght' => '411'
		),
		array(
			'id' => '348',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '412',
			'rght' => '413'
		),
		array(
			'id' => '349',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '820',
			'rght' => '821'
		),
		array(
			'id' => '350',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '414',
			'rght' => '415'
		),
		array(
			'id' => '351',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '416',
			'rght' => '417'
		),
		array(
			'id' => '352',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '418',
			'rght' => '419'
		),
		array(
			'id' => '353',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '822',
			'rght' => '823'
		),
		array(
			'id' => '354',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '420',
			'rght' => '421'
		),
		array(
			'id' => '355',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '422',
			'rght' => '423'
		),
		array(
			'id' => '356',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '424',
			'rght' => '425'
		),
		array(
			'id' => '357',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '824',
			'rght' => '825'
		),
		array(
			'id' => '358',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '426',
			'rght' => '427'
		),
		array(
			'id' => '359',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '428',
			'rght' => '429'
		),
		array(
			'id' => '360',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '430',
			'rght' => '431'
		),
		array(
			'id' => '361',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '7',
			'alias' => NULL,
			'lft' => '979',
			'rght' => '980'
		),
		array(
			'id' => '362',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '8',
			'alias' => NULL,
			'lft' => '826',
			'rght' => '827'
		),
		array(
			'id' => '363',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '828',
			'rght' => '829'
		),
		array(
			'id' => '364',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '432',
			'rght' => '433'
		),
		array(
			'id' => '365',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '434',
			'rght' => '435'
		),
		array(
			'id' => '366',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '436',
			'rght' => '437'
		),
		array(
			'id' => '367',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '830',
			'rght' => '831'
		),
		array(
			'id' => '368',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '438',
			'rght' => '439'
		),
		array(
			'id' => '369',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '440',
			'rght' => '441'
		),
		array(
			'id' => '370',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '442',
			'rght' => '443'
		),
		array(
			'id' => '371',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '832',
			'rght' => '833'
		),
		array(
			'id' => '372',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '444',
			'rght' => '445'
		),
		array(
			'id' => '373',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '446',
			'rght' => '447'
		),
		array(
			'id' => '374',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '448',
			'rght' => '449'
		),
		array(
			'id' => '375',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '9',
			'alias' => NULL,
			'lft' => '981',
			'rght' => '982'
		),
		array(
			'id' => '376',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '10',
			'alias' => NULL,
			'lft' => '983',
			'rght' => '984'
		),
		array(
			'id' => '377',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '11',
			'alias' => NULL,
			'lft' => '985',
			'rght' => '986'
		),
		array(
			'id' => '378',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '12',
			'alias' => NULL,
			'lft' => '987',
			'rght' => '988'
		),
		array(
			'id' => '379',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '13',
			'alias' => NULL,
			'lft' => '834',
			'rght' => '835'
		),
		array(
			'id' => '380',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '14',
			'alias' => NULL,
			'lft' => '836',
			'rght' => '837'
		),
		array(
			'id' => '381',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '15',
			'alias' => NULL,
			'lft' => '838',
			'rght' => '839'
		),
		array(
			'id' => '382',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '16',
			'alias' => NULL,
			'lft' => '989',
			'rght' => '990'
		),
		array(
			'id' => '383',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '17',
			'alias' => NULL,
			'lft' => '840',
			'rght' => '841'
		),
		array(
			'id' => '384',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '18',
			'alias' => NULL,
			'lft' => '450',
			'rght' => '451'
		),
		array(
			'id' => '385',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '19',
			'alias' => NULL,
			'lft' => '842',
			'rght' => '843'
		),
		array(
			'id' => '386',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '20',
			'alias' => NULL,
			'lft' => '991',
			'rght' => '992'
		),
		array(
			'id' => '387',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '21',
			'alias' => NULL,
			'lft' => '844',
			'rght' => '845'
		),
		array(
			'id' => '388',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '22',
			'alias' => NULL,
			'lft' => '452',
			'rght' => '453'
		),
		array(
			'id' => '389',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '23',
			'alias' => NULL,
			'lft' => '846',
			'rght' => '847'
		),
		array(
			'id' => '390',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '24',
			'alias' => NULL,
			'lft' => '848',
			'rght' => '849'
		),
		array(
			'id' => '391',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '25',
			'alias' => NULL,
			'lft' => '850',
			'rght' => '851'
		),
		array(
			'id' => '392',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '26',
			'alias' => NULL,
			'lft' => '852',
			'rght' => '853'
		),
		array(
			'id' => '393',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '27',
			'alias' => NULL,
			'lft' => '854',
			'rght' => '855'
		),
		array(
			'id' => '394',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '28',
			'alias' => NULL,
			'lft' => '856',
			'rght' => '857'
		),
		array(
			'id' => '395',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '29',
			'alias' => NULL,
			'lft' => '858',
			'rght' => '859'
		),
		array(
			'id' => '396',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '30',
			'alias' => NULL,
			'lft' => '860',
			'rght' => '861'
		),
		array(
			'id' => '397',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '31',
			'alias' => NULL,
			'lft' => '862',
			'rght' => '863'
		),
		array(
			'id' => '398',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '32',
			'alias' => NULL,
			'lft' => '864',
			'rght' => '865'
		),
		array(
			'id' => '399',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '33',
			'alias' => NULL,
			'lft' => '866',
			'rght' => '867'
		),
		array(
			'id' => '400',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '34',
			'alias' => NULL,
			'lft' => '868',
			'rght' => '869'
		),
		array(
			'id' => '401',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '35',
			'alias' => NULL,
			'lft' => '870',
			'rght' => '871'
		),
		array(
			'id' => '402',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '36',
			'alias' => NULL,
			'lft' => '872',
			'rght' => '873'
		),
		array(
			'id' => '403',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '37',
			'alias' => NULL,
			'lft' => '874',
			'rght' => '875'
		),
		array(
			'id' => '404',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '38',
			'alias' => NULL,
			'lft' => '876',
			'rght' => '877'
		),
		array(
			'id' => '405',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '39',
			'alias' => NULL,
			'lft' => '878',
			'rght' => '879'
		),
		array(
			'id' => '406',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '40',
			'alias' => NULL,
			'lft' => '880',
			'rght' => '881'
		),
		array(
			'id' => '407',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '41',
			'alias' => NULL,
			'lft' => '882',
			'rght' => '883'
		),
		array(
			'id' => '408',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '42',
			'alias' => NULL,
			'lft' => '884',
			'rght' => '885'
		),
		array(
			'id' => '409',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '43',
			'alias' => NULL,
			'lft' => '886',
			'rght' => '887'
		),
		array(
			'id' => '410',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '44',
			'alias' => NULL,
			'lft' => '888',
			'rght' => '889'
		),
		array(
			'id' => '411',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '45',
			'alias' => NULL,
			'lft' => '890',
			'rght' => '891'
		),
		array(
			'id' => '412',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '46',
			'alias' => NULL,
			'lft' => '892',
			'rght' => '893'
		),
		array(
			'id' => '413',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '47',
			'alias' => NULL,
			'lft' => '894',
			'rght' => '895'
		),
		array(
			'id' => '414',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '48',
			'alias' => NULL,
			'lft' => '993',
			'rght' => '994'
		),
		array(
			'id' => '415',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '49',
			'alias' => NULL,
			'lft' => '896',
			'rght' => '897'
		),
		array(
			'id' => '416',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '50',
			'alias' => NULL,
			'lft' => '454',
			'rght' => '455'
		),
		array(
			'id' => '417',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '51',
			'alias' => NULL,
			'lft' => '898',
			'rght' => '899'
		),
		array(
			'id' => '418',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '52',
			'alias' => NULL,
			'lft' => '900',
			'rght' => '901'
		),
		array(
			'id' => '419',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '53',
			'alias' => NULL,
			'lft' => '902',
			'rght' => '903'
		),
		array(
			'id' => '420',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '54',
			'alias' => NULL,
			'lft' => '904',
			'rght' => '905'
		),
		array(
			'id' => '421',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '55',
			'alias' => NULL,
			'lft' => '906',
			'rght' => '907'
		),
		array(
			'id' => '422',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '56',
			'alias' => NULL,
			'lft' => '908',
			'rght' => '909'
		),
		array(
			'id' => '423',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '57',
			'alias' => NULL,
			'lft' => '910',
			'rght' => '911'
		),
		array(
			'id' => '424',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '58',
			'alias' => NULL,
			'lft' => '995',
			'rght' => '996'
		),
		array(
			'id' => '425',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '59',
			'alias' => NULL,
			'lft' => '912',
			'rght' => '913'
		),
		array(
			'id' => '426',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '914',
			'rght' => '915'
		),
		array(
			'id' => '427',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '5',
			'alias' => NULL,
			'lft' => '916',
			'rght' => '917'
		),
		array(
			'id' => '428',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '6',
			'alias' => NULL,
			'lft' => '918',
			'rght' => '919'
		),
		array(
			'id' => '429',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '7',
			'alias' => NULL,
			'lft' => '920',
			'rght' => '921'
		),
		array(
			'id' => '430',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '8',
			'alias' => NULL,
			'lft' => '922',
			'rght' => '923'
		),
		array(
			'id' => '431',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '9',
			'alias' => NULL,
			'lft' => '924',
			'rght' => '925'
		),
		array(
			'id' => '432',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '10',
			'alias' => NULL,
			'lft' => '926',
			'rght' => '927'
		),
		array(
			'id' => '433',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '11',
			'alias' => NULL,
			'lft' => '928',
			'rght' => '929'
		),
		array(
			'id' => '434',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '12',
			'alias' => NULL,
			'lft' => '930',
			'rght' => '931'
		),
		array(
			'id' => '435',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '13',
			'alias' => NULL,
			'lft' => '932',
			'rght' => '933'
		),
		array(
			'id' => '436',
			'parent_id' => NULL,
			'model' => 'User',
			'foreign_key' => '14',
			'alias' => NULL,
			'lft' => '997',
			'rght' => '998'
		),
		array(
			'id' => '437',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '15',
			'alias' => NULL,
			'lft' => '934',
			'rght' => '935'
		),
		array(
			'id' => '438',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '16',
			'alias' => NULL,
			'lft' => '936',
			'rght' => '937'
		),
		array(
			'id' => '439',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '17',
			'alias' => NULL,
			'lft' => '938',
			'rght' => '939'
		),
		array(
			'id' => '440',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '940',
			'rght' => '941'
		),
		array(
			'id' => '441',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '456',
			'rght' => '457'
		),
		array(
			'id' => '442',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '458',
			'rght' => '459'
		),
		array(
			'id' => '443',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '460',
			'rght' => '461'
		),
		array(
			'id' => '444',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '942',
			'rght' => '943'
		),
		array(
			'id' => '445',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '462',
			'rght' => '463'
		),
		array(
			'id' => '446',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '464',
			'rght' => '465'
		),
		array(
			'id' => '447',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '466',
			'rght' => '467'
		),
		array(
			'id' => '448',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '944',
			'rght' => '945'
		),
		array(
			'id' => '449',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '468',
			'rght' => '469'
		),
		array(
			'id' => '450',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '470',
			'rght' => '471'
		),
		array(
			'id' => '451',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '472',
			'rght' => '473'
		),
		array(
			'id' => '452',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '946',
			'rght' => '947'
		),
		array(
			'id' => '453',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '474',
			'rght' => '475'
		),
		array(
			'id' => '454',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '476',
			'rght' => '477'
		),
		array(
			'id' => '455',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '478',
			'rght' => '479'
		),
		array(
			'id' => '456',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '948',
			'rght' => '949'
		),
		array(
			'id' => '457',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '480',
			'rght' => '481'
		),
		array(
			'id' => '458',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '482',
			'rght' => '483'
		),
		array(
			'id' => '459',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '484',
			'rght' => '485'
		),
		array(
			'id' => '460',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '18',
			'alias' => NULL,
			'lft' => '950',
			'rght' => '951'
		),
		array(
			'id' => '461',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '952',
			'rght' => '953'
		),
		array(
			'id' => '462',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '486',
			'rght' => '487'
		),
		array(
			'id' => '463',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '488',
			'rght' => '489'
		),
		array(
			'id' => '464',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '490',
			'rght' => '491'
		),
		array(
			'id' => '465',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '954',
			'rght' => '955'
		),
		array(
			'id' => '466',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '492',
			'rght' => '493'
		),
		array(
			'id' => '467',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '494',
			'rght' => '495'
		),
		array(
			'id' => '468',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '496',
			'rght' => '497'
		),
		array(
			'id' => '469',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '498',
			'rght' => '499'
		),
		array(
			'id' => '470',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '500',
			'rght' => '501'
		),
		array(
			'id' => '471',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '502',
			'rght' => '503'
		),
		array(
			'id' => '472',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '504',
			'rght' => '505'
		),
		array(
			'id' => '473',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '506',
			'rght' => '507'
		),
		array(
			'id' => '474',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '508',
			'rght' => '509'
		),
		array(
			'id' => '475',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '510',
			'rght' => '511'
		),
		array(
			'id' => '476',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '956',
			'rght' => '957'
		),
		array(
			'id' => '477',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '512',
			'rght' => '513'
		),
		array(
			'id' => '478',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '514',
			'rght' => '515'
		),
		array(
			'id' => '479',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '516',
			'rght' => '517'
		),
		array(
			'id' => '480',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '958',
			'rght' => '959'
		),
		array(
			'id' => '481',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '518',
			'rght' => '519'
		),
		array(
			'id' => '482',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '520',
			'rght' => '521'
		),
		array(
			'id' => '483',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '522',
			'rght' => '523'
		),
		array(
			'id' => '484',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '960',
			'rght' => '961'
		),
		array(
			'id' => '485',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '524',
			'rght' => '525'
		),
		array(
			'id' => '486',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '526',
			'rght' => '527'
		),
		array(
			'id' => '487',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '528',
			'rght' => '529'
		),
		array(
			'id' => '488',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '962',
			'rght' => '963'
		),
		array(
			'id' => '489',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '530',
			'rght' => '531'
		),
		array(
			'id' => '490',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '532',
			'rght' => '533'
		),
		array(
			'id' => '491',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '534',
			'rght' => '535'
		),
		array(
			'id' => '492',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '964',
			'rght' => '965'
		),
		array(
			'id' => '493',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '536',
			'rght' => '537'
		),
		array(
			'id' => '494',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '538',
			'rght' => '539'
		),
		array(
			'id' => '495',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '540',
			'rght' => '541'
		),
		array(
			'id' => '496',
			'parent_id' => '5',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '966',
			'rght' => '967'
		),
		array(
			'id' => '497',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '542',
			'rght' => '543'
		),
		array(
			'id' => '498',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '544',
			'rght' => '545'
		),
		array(
			'id' => '499',
			'parent_id' => '4',
			'model' => 'User',
			'foreign_key' => '4',
			'alias' => NULL,
			'lft' => '546',
			'rght' => '547'
		),
	);
}
