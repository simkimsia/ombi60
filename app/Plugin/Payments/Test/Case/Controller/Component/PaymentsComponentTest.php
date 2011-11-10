<?php
/* Payments Test cases generated on: 2011-11-10 15:31:16 : 1320939076*/
App::uses('PaymentsComponent', 'Payments.Controller/Component');
App::uses('ComponentCollection', 'Controller');

/**
 * PaymentsComponent Test Case
 *
 */
class PaymentsComponentTestCase extends CakeTestCase {
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ComponentCollection = new ComponentCollection();
		$this->Payments = new PaymentsComponent($this->ComponentCollection);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Payments);

		parent::tearDown();
	}

/**
 * testSetupPurchase method
 *
 * @return void
 */
	public function testSetupPurchase() {
		$paypalExpress = $this->getMock('PaypalExpressComponent', array('setupPurchase'));
		$paypalExpress->expects($this->once())->method('setupPurchase')->with($this->equalTo(array('amount' => 10)));
		$this->Payments->setupPurchase('Paypal Express Checkout', array('amount' => 10));
	}

/**
 * testPurchase method
 *
 * @return void
 */
	public function testPurchase() {

	}

/**
 * testRedirect method
 *
 * @return void
 */
	public function testRedirect() {

	}

/**
 * testGetFromResponse method
 *
 * @return void
 */
	public function testGetFromResponse() {

	}

/**
 * testIsPaypalExpress method
 *
 * @return void
 */
	public function testIsPaypalExpress() {
		$this->assertTrue($this->Payments->isPaypalExpress('Paypal Express Checkout'));
		$this->assertFalse($this->Payments->isPaypalExpress('Another Payment Gateway'));	
	}

}
