<?php
/* PaymentGateway Test cases generated on: 2011-11-10 15:31:16 : 1320939076*/
App::uses('PaymentGatewayComponent', 'PaymentGateway.Controller/Component');
App::uses('ComponentCollection', 'Controller');
App::uses('Controller', 'Controller');
App::uses('PaypalExpressComponent', 'PaymentGateway.Controller/Component');
require_once App::pluginPath('PaymentGateway') . 'Vendor' . DS . 'AktiveMerchant'.DS.'lib'.DS.'merchant'.DS.'billing'.DS.'Response.php';
require_once App::pluginPath('PaymentGateway') . 'Vendor' . DS . 'AktiveMerchant'.DS.'lib'.DS.'merchant'.DS.'billing'.DS.'gateways'.DS.'paypal'.DS.'PaypalExpressResponse.php';

/**
 * PaymentGatewayComponent Test Case
 *
 */
class PaymentGatewayComponentTestCase extends CakeTestCase {
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ComponentCollection = new ComponentCollection();
		$paypalExpress = $this->getMock('PaypalExpressComponent', array('setupPurchase', 'purchase', 'getUrlForToken'), array(new ComponentCollection(), array()));
		$controller = $this->getMock('Controller', array('redirect'));
		$paypalExpressResponse = new Merchant_Billing_PaypalExpressResponse(true, 'Success Payment', array('parameter' => 'parameter_value', 'TOKEN' => 'TOKEN'), array());
		$paypalExpress->response = $paypalExpressResponse;
		$this->ComponentCollection->set('PaypalExpress', $paypalExpress);
		$this->PaymentGateway = new PaymentGatewayComponent($this->ComponentCollection);
		$this->PaymentGateway->initialize($controller);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PaymentGateway);
		parent::tearDown();
	}

/**
 * testSetupPurchase method
 *
 * @return void
 */
	public function testSetupPurchase() {
		$this->PaymentGateway->PaypalExpress->expects($this->once())->method('setupPurchase')->with($this->equalTo(array('amount' => 10)));
		$this->PaymentGateway->setupPurchase('Paypal Express Checkout', array('amount' => 10));
		//Add more tests for future gateways
	}

/**
 * testPurchase method
 *
 * @return void
 */
	public function testPurchase() {
		$this->PaymentGateway->PaypalExpress->expects($this->once())->method('purchase')->with($this->equalTo(array('amount' => 10)));
		$this->PaymentGateway->purchase('Paypal Express Checkout', array('amount' => 10));
		//Add more tests for future gateways
	}

/**
 * testRedirect method
 *
 * @return void
 */
	public function testRedirect() {
		$this->PaymentGateway->PaypalExpress->expects($this->once())->method('getUrlForToken')->with($this->equalTo('TOKEN'))->will($this->returnValue('URL'));
		$this->PaymentGateway->controller->expects($this->once())->method('redirect')->with('URL');
		$this->PaymentGateway->redirect('Paypal Express Checkout', array());
	}

/**
 * testGetFromResponse method
 *
 * @return void
 */
	public function testGetFromResponse() {
		$value = $this->PaymentGateway->getFromResponse('Paypal Express Checkout', 'parameter');
		$this->assertEqual($value, 'parameter_value');
	}

/**
 * testIsPaypalExpress method
 *
 * @return void
 */
	public function testIsPaypalExpress() {
		$this->assertTrue($this->PaymentGateway->isPaypalExpress('Paypal Express Checkout'));
		$this->assertFalse($this->PaymentGateway->isPaypalExpress('Another Payment Gateway'));	
	}

}
