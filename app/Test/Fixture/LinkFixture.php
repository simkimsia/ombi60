<?php
/* Link Fixture generated on: 2011-10-13 05:55:47 : 1318485347 */

/**
 * LinkFixture
 *
 */
class LinkFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'collate' => NULL, 'comment' => ''),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'route' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'link_list_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'collate' => NULL, 'comment' => ''),
		'model' => array('type' => 'string', 'null' => true, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'action' => array('type' => 'string', 'null' => true, 'length' => 155, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'order' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 2, 'collate' => NULL, 'comment' => ''),
		'parent_model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'comment' => '', 'charset' => 'utf8'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'collate' => NULL, 'comment' => ''),
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
			'name' => 'Home',
			'route' => '/',
			'link_list_id' => '1',
			'model' => '/',
			'action' => '',
			'order' => '0',
			'parent_model' => NULL,
			'parent_id' => '0'
		),
		array(
			'id' => '2',
			'name' => 'About Us',
			'route' => '/pages/about-us',
			'link_list_id' => '1',
			'model' => '/pages/',
			'action' => 'about-us',
			'order' => '1',
			'parent_model' => 'Webpage',
			'parent_id' => '3'
		),
		array(
			'id' => '3',
			'name' => 'Catalogue',
			'route' => '/collections/all',
			'link_list_id' => '1',
			'model' => '/collections/all',
			'action' => '',
			'order' => '2',
			'parent_model' => NULL,
			'parent_id' => '0'
		),
		array(
			'id' => '4',
			'name' => 'Blog',
			'route' => '/blogs/news',
			'link_list_id' => '1',
			'model' => '/blogs/',
			'action' => 'news',
			'order' => '3',
			'parent_model' => 'Blog',
			'parent_id' => '1'
		),
		array(
			'id' => '5',
			'name' => 'Cart',
			'route' => '/cart',
			'link_list_id' => '1',
			'model' => '/cart',
			'action' => '',
			'order' => '4',
			'parent_model' => NULL,
			'parent_id' => '0'
		),
		array(
			'id' => '6',
			'name' => 'Terms of Service',
			'route' => '/pages/terms-of-service',
			'link_list_id' => '2',
			'model' => '/pages/',
			'action' => 'terms-of-service',
			'order' => '0',
			'parent_model' => 'Webpage',
			'parent_id' => '4'
		),
		array(
			'id' => '7',
			'name' => 'About Us',
			'route' => '/pages/about-us',
			'link_list_id' => '2',
			'model' => '/pages/',
			'action' => 'about-us',
			'order' => '1',
			'parent_model' => 'Webpage',
			'parent_id' => '3'
		),
	);
}
