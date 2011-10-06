<?php
/* Address Test cases generated on: 2011-09-22 09:42:11 : 1316684531*/
App::uses('Address', 'Model');

/**
 * Address Test Case
 *
 */
class AddressTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.address', 'app.saved_theme', 'app.user', 
		'app.shop_setting', 'app.shop', 'app.domain', 
		'app.post', 'app.comment', 'app.link', 
		'app.link_list', 'app.product', 'app.webpage', 
		'app.customer'
	);
	
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Address = ClassRegistry::init('Address');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Address);
		ClassRegistry::flush();

		parent::tearDown();
	}

/**
 * testGetAllByCustomerId method
 *
 * @return void
 */
	public function testGetAllByCustomer() {
		// negative test
		$result = $this->Address->getAllByCustomer(0, DELIVERY);
		$this->assertFalse(!empty($result));
		
		// positive test
		/*
		$this->assertTrue(!empty($result));
		$this->assertTrue(!empty($result['Language']));
		$this->assertEqual($result['Language']['name'], 'English');
		*/
	}

}
