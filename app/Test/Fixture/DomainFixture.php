<?php
/* Domain Fixture generated on: 2011-09-21 14:19:47 : 1316614787 */

/**
 * DomainFixture
 *
 */
class DomainFixture extends CakeTestFixture {
/**
 * Import
 *
 * @var array
 */
	public $import = array('model' => 'Domain');


/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'domain' => 'http://ombi60.localhost',
			'shop_id' => '1',
			'primary' => 1,
			'always_redirect_here' => 0,
			'shop_web_address' => 0
		),
		array(
			'id' => '2',
			'domain' => 'http://localhost',
			'shop_id' => '2',
			'primary' => 1,
			'always_redirect_here' => 0,
			'shop_web_address' => 1
		),
	);
}
