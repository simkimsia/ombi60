<?php
/* PaypalExpress Test cases generated on: 2011-11-10 15:31:33 : 1320939093*/
App::uses('PaypalExpressComponent', 'Payments.Controller/Component');
require_once App::pluginPath('Payments') . 'Vendor' . DS . 'AktiveMerchant'.DS.'lib'.DS.'merchant'.DS.'billing'.DS.'Response.php';
require_once App::pluginPath('Payments') . 'Vendor' . DS . 'AktiveMerchant'.DS.'lib'.DS.'merchant'.DS.'billing'.DS.'Expect.php';
require_once App::pluginPath('Payments') . 'Vendor' . DS . 'AktiveMerchant'.DS.'lib'.DS.'merchant'.DS.'billing'.DS.'Gateway.php';
require_once App::pluginPath('Payments') . 'Vendor' . DS . 'AktiveMerchant'.DS.'lib'.DS.'merchant'.DS.'billing'.DS.'gateways'.DS.'paypal'.DS.'PaypalExpressResponse.php';
require_once App::pluginPath('Payments') . 'Vendor' . DS . 'AktiveMerchant'.DS.'lib'.DS.'merchant'.DS.'billing'.DS.'gateways'.DS.'PaypalExpress.php';

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
		$paypalExpress = $this->getMock('Merchant_Billing_PaypalExpress', array('setup_purchase', 'url_for_token', 'get_details_for', 'purchase'), array(array('login' => 'login', 'password' => 'password', 'signature' => 'signature')));
		$this->paypalExpressResponse = new Merchant_Billing_PaypalExpressResponse(true, 'Success Payment', array('parameter' => 'parameter_value', 'TOKEN' => 'TOKEN', 'AMT' => 10), array());
		$this->PaypalExpress = new PaypalExpressComponent(new ComponentCollection(), array());
		$this->PaypalExpress->datasource->gateway = $paypalExpress;
		
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
		$purchaseInfo['amount'] = 10;
		$this->PaypalExpress->datasource->gateway->expects($this->once())->method('setup_purchase')->with($this->equalTo($purchaseInfo['amount']))->will($this->returnValue($this->paypalExpressResponse));
		$this->PaypalExpress->setupPurchase($purchaseInfo);
		$this->assertEquals($this->PaypalExpress->getResponse(), $this->paypalExpressResponse);
	}

/**
 * testGetUrlForToken method
 *
 * @return void
 */
	public function testGetUrlForToken() {
		$this->PaypalExpress->datasource->gateway->expects($this->once())->method('url_for_token')->with($this->equalTo('TOKEN'))->will($this->returnValue('URL-TOKEN'));
		$this->assertEquals($this->PaypalExpress->getUrlForToken('TOKEN'), 'URL-TOKEN');
	}

/**
 * testPurchase method
 *
 * @return void
 */
	public function testPurchase() {
		$purchaseInfo['token'] = 'TOKEN';
		$purchaseInfo['PayerID'] = 'PAYER-ID';
		$purchaseInfo['amount'] = 10;
		$this->PaypalExpress->datasource->gateway->expects($this->once())->method('get_details_for')->with($this->equalTo($purchaseInfo['token']), $this->equalTo($purchaseInfo['PayerID']), $this->equalTo($purchaseInfo))->will($this->returnValue($this->paypalExpressResponse));
		$this->PaypalExpress->datasource->gateway->expects($this->once())->method('purchase')->with($this->paypalExpressResponse->amount(), $this->equalTo($purchaseInfo))->will($this->returnValue($this->paypalExpressResponse));
		$response = $this->PaypalExpress->purchase($purchaseInfo);
		$this->assertEquals($response, $this->paypalExpressResponse);
	}

}
