<?php
App::uses('DataSource', 'Model/Datasource');
require_once(App::pluginPath('PaymentGateway') . 'Vendor' . DS . 'AktiveMerchant' . DS . 'lib' . DS . 'merchant.php');

/** 
 * This class implements Paypal Express datasource to store the payment gateway and settings
 * @author ajibarra
 *
 */
class PaypalExpressSource extends DataSource {

/**
 * Holds the config for communicating with Paypal
 *
 * ### Possible configuration keys
 *
 *	- environment: defines whether to use a live or testing environment, possible values test, live (default: live)
 *  - login: defines the login to use with paypal express api
 *  - password: defines the password to use with paypal express api
 *  - signature: defines the signature to use with paypal express api,
 *  - return_url: defines the return url to use with paypal express api
 *  - cancel_url: defines the cancel url to use with paypal express api
 *  - currency: defines the default currency to use with paypal express api
 * @var array
 */
	public $config = array(
		'environment' => 'live',
		'currency' => 'USD'
	);

/**
 * Holds the payment gateway initialized
 */
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
}