<?php
/* SmartCollectionCondition Fixture generated on: 2011-10-25 08:41:42 : 1319532102 */

/**
 * SmartCollectionConditionFixture
 *
 */
class SmartCollectionConditionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'smart_collection_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'field' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
		'relation' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
		'condition' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
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
			'smart_collection_id' => '2',
			'field' => 'Product.price',
			'relation' => 'greater_than',
			'condition' => '1',
			'created' => '2011-10-25 08:40:37',
			'modified' => '2011-10-25 08:40:37'
		),
	);
}
