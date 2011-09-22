<?php
/* Domain Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('Domain', 'Model');

/**
 * Domain Test Case
 *
 */
class DomainTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.domain', 'app.shop');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Domain = ClassRegistry::init('Domain');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Domain);
		ClassRegistry::flush();

		parent::tearDown();
	}

/**
 * testMakeThisPrimary method
 *
 * @return void
 */
	public function testMakeThisPrimary() {
		$primary = $this->Domain->read(null, '2'); //current primary
		$noPrimary = $this->Domain->read(null, '3'); //no primary
		$this->assertTrue($primary['Domain']['primary']);
		$this->assertFalse($noPrimary['Domain']['primary']);
		$this->Domain->make_this_primary('3', '2');
		$primary = $this->Domain->read(null, '3'); //new primary
		$noPrimary = $this->Domain->read(null, '2'); //no primary
		$this->assertTrue($primary['Domain']['primary']);
		$this->assertFalse($noPrimary['Domain']['primary']);
	}

}
