<?php
App::uses('HttpSocket', 'Network/Http');
App::uses('DataSource', 'Model/Datasource');
require_once(App::pluginPath('Payments') . 'Vendor' . DS . 'AktiveMerchant' . DS . 'lib' . DS . 'merchant.php');

class PaypalExpressSource extends DataSource {

/**
 * Holds the config for communicating with Paypal
 *
 * ### Possible configuration keys
 *
 *	- environment: defines whether to use a live or testing environment, possible values sandbox, live (default: live)
 *	- business: email which was used to setup the Paypal seller or sandbox account
 *
 * @var array
 */
	public $config = array(
		'environment' => 'live',
		'currency' => 'USD'
	);

	public $gateway;
	
	public $returnUrl;
	
	public $cancelUrl;
	
/**
 * Holds the last errors from communicating with the API
 *
 * @var string
 */
	public $errors;

	public function __construct($config = array()) {
		$this->setConfig($config);
		Merchant_Billing_Base::mode($this->config['environment']);
		$this->gateway = new Merchant_Billing_PaypalExpress( array(
			'login' => $this->config['login'],
			'password' => $this->config['password'],
			'signature' => $this->config['signature'],
			'currency' => $this->config['currency']
		));
		$this->returnUrl = $config['return_url'];
		$this->cancelUrl = $config['cancel_url'];
	}

	public function getCancelUrl() {
		return $this->cancelUrl;
	}
	
	public function getReturnUrl() {
		return $this->returnUrl;
	}
	
	public function getGateway() {
		return $this->gateway;
	}

/**
 * Returns a new HttpSocket object
 *
 * @return HttpSocket object
 */
	protected function _getConnection() {
		return new HttpSocket();
	}


}

class PaypalExpressException extends Exception {
	protected $serverResponse;

	public function setServerResponse($response) {
		$this->response = $response;
	}

	public function getServerResponse() {
		return $response;
	}
}