<?php

class PaypalSelenium {
	
	public $defaults = array(
		'sandbox' => array(
			'login_email' => '',
			'login_password' => '',
			'customer_email' => '',
			'customer_password' => ''
		),
		'live' => array()
	);
	
	
	public function __construct($settings = array()) {
		if (!empty($settings)) {
			$this->defaults['sandbox'] = array_merge($this->defaults['sandbox'], $settings['sandbox']);			
		}
	}
	
	/**
	* Uses the SeleniumTestCase class to run login to sandbox account
	*
	**/
	public function loginToSandbox(&$seleniumTestCase) {
		
		$seleniumTestCase->open('https://developer.paypal.com');
		$seleniumTestCase->waitForPageToLoad(30000);

		$seleniumTestCase->assertLocation('regexp:https://developer.paypal.com');
		$seleniumTestCase->type('id=login_email', $this->defaults['sandbox']['login_email']);
		$seleniumTestCase->type('id=login_password', $this->defaults['sandbox']['login_password']);
		$seleniumTestCase->click('css=input[type="submit"]');
		$seleniumTestCase->waitForPageToLoad(30000);

	}
	
	/**
	* Uses the SeleniumtestCase class to login as customer and pay
	**/
	public function loginToPayAtSandbox(&$seleniumTestCase) {
		// to ensure that the login page is used instead of the credit card page
		$seleniumTestCase->click('css=input[type="submit"][id="loadLogin"]');
		$seleniumTestCase->waitForPageToLoad(30000);

		// fill in login credentials
		$seleniumTestCase->type('id=login_email', $this->defaults['sandbox']['customer_email']);
		$seleniumTestCase->type('id=login_password', $this->defaults['sandbox']['customer_password']);
		$seleniumTestCase->click('css=input[type="submit"][id="submitLogin"]');
		$seleniumTestCase->waitForPageToLoad(30000);

		// confirmation
		$seleniumTestCase->click('css=input[type="submit"][id="continue"]');
		$seleniumTestCase->waitForPageToLoad(30000);
	}

	
}
?>