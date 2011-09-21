<?php
/* Blog Fixture generated on: 2011-09-21 14:36:42 : 1316615802 */

/**
 * BlogFixture
 *
 */
class BlogFixture extends CakeTestFixture {
/**
 * Import
 *
 * @var array
 */
	public $import = array('model' => 'Blog');


/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '2',
			'title' => 'news',
			'short_name' => 'news',
			'description' => NULL,
			'theme' => NULL,
			'created' => '2011-09-16 17:56:03',
			'modified' => '2011-09-16 17:56:03',
			'shop_id' => NULL,
			'visible_post_count' => '0',
			'all_post_count' => '0'
		),
		array(
			'id' => '3',
			'title' => 'Test',
			'short_name' => 'test',
			'description' => NULL,
			'theme' => NULL,
			'created' => '2011-09-17 14:38:45',
			'modified' => '2011-09-17 14:38:45',
			'shop_id' => '2',
			'visible_post_count' => '2',
			'all_post_count' => '2'
		),
	);
}
