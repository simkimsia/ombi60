<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

define('SELENIUM_TEST_ALL', 'all');

define('SELENIUM_TEST_WHITELIST', 'white');

define('SELENIUM_TEST_NOT_ON_BLACKLIST', 'black');
 
class IsolatedAdminPagesTest extends PHPUnit_Extensions_SeleniumTestCase
{
	
	public $localhost 				= true;
	public $domains 				= 
		array(
			'localhost' => 'http://shop001.ombi60.localhost/',
			'production'=> 'http://');
			
			
	public $checkoutDomains 		= array(
		'localhost'	=> 'https://checkout.ombi60.localhost/',
		'production' => 'https://checkout.ombi60.com/'
	);
								
	public $secondsBetweenCommands 	= 2;
	
	public $testRange = SELENIUM_TEST_ALL;	
	
	public $whiteList = array('testHandleizeInDummyProduct');
	
	public $blackList = array();
	
	public $baseUrl  = '';
	
	public $baseCheckoutUrl = 'https://checkout.ombi60.localhost/';
	
	
	public function loginToSandboxPaypal(&$seleniumTestCase) {
		
		/*
		$currentLocation = $seleniumTestCase->getLocation();
		
		// if at sandbox page prompting for login
		$seleniumTestCase->assertLocation('regexp:^https://www.sandbox.paypal.com/cgi-bin/webscr');
//		if (strpos($currentLocation, 'https://www.sandbox.paypal.com/cgi-bin/webscr') == 0) {
		$seleniumTestCase->click('css=a[href="https://developer.paypal.com/"]');
		*/
		$seleniumTestCase->open('https://developer.paypal.com');
		$seleniumTestCase->waitForPageToLoad(30000);
		
		
//		}
		$seleniumTestCase->assertLocation('regexp:https://developer.paypal.com');
		
		$seleniumTestCase->type('id=login_email', 'developer@ombi60.com');
		$seleniumTestCase->type('id=login_password', 'd3v31234');
		$seleniumTestCase->click('css=input[type="submit"]');
		$seleniumTestCase->waitForPageToLoad(30000);
		
		//$seleniumTestCase->assertLocation('regexp:https://developer.paypal.com/cgi-bin/devscr?cmd=_login-done&login_access=0');

	}
	
	public function loginToPayAtSandboxPaypal(&$seleniumTestCase) {
		// to ensure that the login page is used instead of the credit card page
		$seleniumTestCase->click('css=input[type="submit"][id="loadLogin"]');
		$seleniumTestCase->waitForPageToLoad(30000);
		
		// fill in login credentials
		$seleniumTestCase->type('id=login_email', 'shopper_sg@gmail.com');
		$seleniumTestCase->type('id=login_password', 'customer');
		$seleniumTestCase->click('css=input[type="submit"][id="submitLogin"]');
		$seleniumTestCase->waitForPageToLoad(30000);
		
		// confirmation
		$seleniumTestCase->click('css=input[type="submit"][id="continue"]');
		$seleniumTestCase->waitForPageToLoad(30000);
	}
	
	/**
	 *
	 * Setup before running all the test cases
	**/
    protected function setUp() {
        $this->setBrowser('*firefox');

		if ($this->localhost) {

			$this->setBrowserUrl($this->domains['localhost']);
			$this->baseUrl = $this->domains['localhost'];


		} else {
			$this->setBrowserUrl($this->domains['production']);
			$this->baseUrl = $this->domains['production'];

		}
        
		$this->setSleep($this->secondsBetweenCommands);
		
    }

	/**
	 * 
	 * We use this private function to avoid running tests we don't care about
	 * 
	 * @param string $functionName Name of the test case
	**/
	private function doNotRunThisTest($functionName) {
		if ($this->testRange === SELENIUM_TEST_WHITELIST && 
			in_array($functionName, $this->whiteList)) {
			return false;
		} else if (	$this->testRange === SELENIUM_TEST_NOT_ON_BLACKLIST && 
				!in_array($functionName, $this->blackList)) {
			return false;
		} else if ($this->testRange === SELENIUM_TEST_ALL) {
			return false;
		}
		
		return true;
	}

	/**
	 *
	 * This replaces the OrdersController test for Redirect for create_order action
	 *
	 *
	**/
	public function testPaypalShouldWorkForGuestCustomerOpeningSingleStoreInBrowser() {
		
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
		
		$this->loginToSandboxPaypal($this);
		
		// GIVEN at checkout page 1 aka carts view action
		//$this->open('cart');
		// https://checkout.ombi60.localhost/carts/2/4e895a91-b374-4a1a-947c-0b701507707a
		$this->open($this->baseCheckoutUrl . 'carts/2/4e895a91-b374-4a1a-947c-0b701507707a');
		
		$this->assertElementPresent('xpath=//span[@class="font_bold"][contains(text(), "You are using our secure server")]');
		
		// AND we fill in the form correctly
		$this->type('id=UserEmail', 'guest_customer@ombi60.com');
		$this->type('id=BillingAddress0FullName', 'G. Cherry');
		$this->type('id=BillingAddress0Address', 'Billing Address St. Block 123 #01-911');
		$this->type('id=BillingAddress0City', 'Singapore');
		$this->type('id=BillingAddress0ZipCode', '11111');
		$this->select('id=BillingAddress0Country', 'label=Singapore');
		
		// AND submit to create_order action
		$this->assertElementPresent('xpath=//form[@action="/carts/2/4e895a91-b374-4a1a-947c-0b701507707a/create_order"]');
		$this->clickAndWait('css=input[type="submit"]');
		
		// AND we reach pay action
		$this->assertLocation('regexp:' . $this->baseCheckoutUrl . 'orders/2/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/pay');
		
		// AND we select Paypal
		$this->click('id=PaymentShopsPaymentModuleId2', 'type=radio');
		
		// AND we click on complete purchase
		$this->click('css=input[type="submit"][value="Complete my purchase"]');
		
		// AND we wait for up to 30 seconds for the sandbox page to show up
		$this->waitForPageToLoad(30000);
		
		// AND we login to pay for the item at sandbox paypal
		$this->loginToPayAtSandboxPaypal($this);
		
		// THEN we reach the success page
		$this->assertLocation('regexp:' . $this->baseCheckoutUrl . 'orders/2/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/completed');
		// AND we run sandbox paypal
		//$this->getPastSandboxPaypal($this);
		/*
		$currentLocation = $this->getLocation();
		$this->assertFalse(strpos($currentLocation, 'google.com'));
		$this->assertTrue((strpos($currentLocation, 'https://www.sandbox.paypal.com/cgi-bin/webscr') == 0));
		*/
		// AND we reach paypal sandbox site
		//$this->assertLocation('regexp:paypal');
		
	}

 
    
}
?>