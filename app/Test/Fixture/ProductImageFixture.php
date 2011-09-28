<?php
/* ProductImage Fixture generated on: 2011-09-28 10:25:58 : 1317205558 */

/**
 * ProductImageFixture
 *
 */
class ProductImageFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'cover' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'collate' => NULL, 'comment' => ''),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'filename' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'dir' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'mimetype' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'filesize' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
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
			'product_id' => '1',
			'cover' => 1,
			'created' => '2010-05-20 07:59:19',
			'modified' => '2010-05-20 07:59:19',
			'filename' => 'default.jpg',
			'dir' => 'uploads\\products',
			'mimetype' => 'image/jpeg',
			'filesize' => '6103'
		),
		array(
			'id' => '2',
			'product_id' => '2',
			'cover' => 1,
			'created' => '2011-07-08 11:54:47',
			'modified' => '2011-07-08 11:54:47',
			'filename' => 'default-0.jpg',
			'dir' => 'uploads/products',
			'mimetype' => 'image/jpeg',
			'filesize' => '6103'
		),
	);
}
