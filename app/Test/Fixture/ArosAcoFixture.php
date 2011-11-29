<?php
/* ArosAco Fixture generated on: 2011-11-29 06:41:35 : 1322548895 */

/**
 * ArosAcoFixture
 *
 */
class ArosAcoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'aro_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index', 'collate' => NULL, 'comment' => ''),
		'aco_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index', 'collate' => NULL, 'comment' => ''),
		'_create' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'_read' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'_update' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'_delete' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'ARO_ACO_KEY' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1), 'aro_id' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1), 'to_aco' => array('column' => 'aco_id', 'unique' => 0), 'to_aro' => array('column' => 'aro_id', 'unique' => 0)),
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
			'aro_id' => '1',
			'aco_id' => '1',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '2',
			'aro_id' => '2',
			'aco_id' => '3',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '3',
			'aro_id' => '2',
			'aco_id' => '1',
			'_create' => '-1',
			'_read' => '-1',
			'_update' => '-1',
			'_delete' => '-1'
		),
		array(
			'id' => '4',
			'aro_id' => '2',
			'aco_id' => '59',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '5',
			'aro_id' => '2',
			'aco_id' => '93',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '6',
			'aro_id' => '2',
			'aco_id' => '204',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '7',
			'aro_id' => '2',
			'aco_id' => '84',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '8',
			'aro_id' => '2',
			'aco_id' => '189',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '9',
			'aro_id' => '3',
			'aco_id' => '1',
			'_create' => '-1',
			'_read' => '-1',
			'_update' => '-1',
			'_delete' => '-1'
		),
		array(
			'id' => '10',
			'aro_id' => '3',
			'aco_id' => '3',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '11',
			'aro_id' => '3',
			'aco_id' => '67',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '12',
			'aro_id' => '3',
			'aco_id' => '70',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '13',
			'aro_id' => '3',
			'aco_id' => '71',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '14',
			'aro_id' => '3',
			'aco_id' => '64',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '15',
			'aro_id' => '3',
			'aco_id' => '63',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '16',
			'aro_id' => '3',
			'aco_id' => '68',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '17',
			'aro_id' => '3',
			'aco_id' => '72',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '18',
			'aro_id' => '3',
			'aco_id' => '69',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '19',
			'aro_id' => '3',
			'aco_id' => '81',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '20',
			'aro_id' => '3',
			'aco_id' => '80',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '21',
			'aro_id' => '3',
			'aco_id' => '133',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '22',
			'aro_id' => '3',
			'aco_id' => '134',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '23',
			'aro_id' => '3',
			'aco_id' => '132',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '24',
			'aro_id' => '3',
			'aco_id' => '136',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '25',
			'aro_id' => '3',
			'aco_id' => '139',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '26',
			'aro_id' => '3',
			'aco_id' => '135',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '27',
			'aro_id' => '3',
			'aco_id' => '140',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '28',
			'aro_id' => '3',
			'aco_id' => '131',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '29',
			'aro_id' => '3',
			'aco_id' => '141',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '30',
			'aro_id' => '3',
			'aco_id' => '143',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '31',
			'aro_id' => '3',
			'aco_id' => '138',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '32',
			'aro_id' => '3',
			'aco_id' => '137',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '33',
			'aro_id' => '3',
			'aco_id' => '111',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '34',
			'aro_id' => '3',
			'aco_id' => '113',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '36',
			'aro_id' => '3',
			'aco_id' => '115',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '37',
			'aro_id' => '3',
			'aco_id' => '112',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '38',
			'aro_id' => '3',
			'aco_id' => '147',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '39',
			'aro_id' => '3',
			'aco_id' => '151',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '40',
			'aro_id' => '3',
			'aco_id' => '150',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '41',
			'aro_id' => '3',
			'aco_id' => '152',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '42',
			'aro_id' => '3',
			'aco_id' => '148',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '43',
			'aro_id' => '3',
			'aco_id' => '149',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '44',
			'aro_id' => '3',
			'aco_id' => '153',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '45',
			'aro_id' => '3',
			'aco_id' => '154',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '46',
			'aro_id' => '3',
			'aco_id' => '181',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '47',
			'aro_id' => '3',
			'aco_id' => '182',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '48',
			'aro_id' => '3',
			'aco_id' => '180',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '49',
			'aro_id' => '3',
			'aco_id' => '179',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '50',
			'aro_id' => '3',
			'aco_id' => '87',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '51',
			'aro_id' => '3',
			'aco_id' => '89',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '52',
			'aro_id' => '3',
			'aco_id' => '90',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '53',
			'aro_id' => '3',
			'aco_id' => '86',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '54',
			'aro_id' => '3',
			'aco_id' => '85',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '55',
			'aro_id' => '3',
			'aco_id' => '88',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '56',
			'aro_id' => '3',
			'aco_id' => '29',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '57',
			'aro_id' => '3',
			'aco_id' => '34',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '58',
			'aro_id' => '3',
			'aco_id' => '32',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '59',
			'aro_id' => '3',
			'aco_id' => '35',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '60',
			'aro_id' => '3',
			'aco_id' => '37',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '61',
			'aro_id' => '3',
			'aco_id' => '36',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '62',
			'aro_id' => '3',
			'aco_id' => '38',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '63',
			'aro_id' => '3',
			'aco_id' => '39',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '64',
			'aro_id' => '3',
			'aco_id' => '31',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '65',
			'aro_id' => '3',
			'aco_id' => '95',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '66',
			'aro_id' => '3',
			'aco_id' => '96',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '67',
			'aro_id' => '3',
			'aco_id' => '94',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '68',
			'aro_id' => '3',
			'aco_id' => '7',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '69',
			'aro_id' => '3',
			'aco_id' => '8',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '70',
			'aro_id' => '3',
			'aco_id' => '10',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '71',
			'aro_id' => '3',
			'aco_id' => '12',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '72',
			'aro_id' => '3',
			'aco_id' => '13',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '73',
			'aro_id' => '3',
			'aco_id' => '9',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '74',
			'aro_id' => '3',
			'aco_id' => '11',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '75',
			'aro_id' => '3',
			'aco_id' => '17',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '76',
			'aro_id' => '3',
			'aco_id' => '19',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '77',
			'aro_id' => '3',
			'aco_id' => '20',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '78',
			'aro_id' => '3',
			'aco_id' => '18',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '79',
			'aro_id' => '3',
			'aco_id' => '21',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '80',
			'aro_id' => '3',
			'aco_id' => '167',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '81',
			'aro_id' => '3',
			'aco_id' => '168',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '82',
			'aro_id' => '3',
			'aco_id' => '190',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '83',
			'aro_id' => '3',
			'aco_id' => '199',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '84',
			'aro_id' => '3',
			'aco_id' => '200',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '85',
			'aro_id' => '3',
			'aco_id' => '201',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '86',
			'aro_id' => '3',
			'aco_id' => '197',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '87',
			'aro_id' => '3',
			'aco_id' => '196',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '88',
			'aro_id' => '3',
			'aco_id' => '198',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '89',
			'aro_id' => '3',
			'aco_id' => '125',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '90',
			'aro_id' => '3',
			'aco_id' => '126',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '91',
			'aro_id' => '3',
			'aco_id' => '127',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '92',
			'aro_id' => '3',
			'aco_id' => '124',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '93',
			'aro_id' => '3',
			'aco_id' => '123',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '94',
			'aro_id' => '3',
			'aco_id' => '219',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '95',
			'aro_id' => '3',
			'aco_id' => '220',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '96',
			'aro_id' => '3',
			'aco_id' => '221',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '97',
			'aro_id' => '3',
			'aco_id' => '218',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '98',
			'aro_id' => '3',
			'aco_id' => '222',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '99',
			'aro_id' => '4',
			'aco_id' => '1',
			'_create' => '-1',
			'_read' => '-1',
			'_update' => '-1',
			'_delete' => '-1'
		),
		array(
			'id' => '100',
			'aro_id' => '4',
			'aco_id' => '3',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '101',
			'aro_id' => '3',
			'aco_id' => '257',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '102',
			'aro_id' => '3',
			'aco_id' => '258',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '103',
			'aro_id' => '3',
			'aco_id' => '259',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '104',
			'aro_id' => '3',
			'aco_id' => '262',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '105',
			'aro_id' => '3',
			'aco_id' => '265',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '106',
			'aro_id' => '3',
			'aco_id' => '266',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
		array(
			'id' => '107',
			'aro_id' => '3',
			'aco_id' => '267',
			'_create' => '1',
			'_read' => '1',
			'_update' => '1',
			'_delete' => '1'
		),
	);
}
