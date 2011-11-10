<?php
/* PaypalExpress Test cases generated on: 2011-11-10 15:31:33 : 1320939093*/
App::uses('PaypalExpressComponent', 'Payments.Controller/Component');

/**
 * PaypalExpressComponent Test Case
 *
 */
class PaypalExpressComponentTestCase extends CakeTestCase {
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->PaypalExpress = new PaypalExpressComponent();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PaypalExpress);

		parent::tearDown();
	}

/**
 * testSetupPurchase method
 *
 * @return void
 */
	public function testSetupPurchase() {

	}

/**
 * testGetUrlForToken method
 *
 * @return void
 */
	public function testGetUrlForToken() {

	}

/**
 * testPurchase method
 *
 * @return void
 */
	public function testPurchase() {

	}

}
