<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

$currentDirectory = dirname(__FILE__);
require_once $currentDirectory . '/../../../Vendor/PaymentSelenium/PaypalSelenium.php';

define('SELENIUM_TEST_ALL', 'all');

define('SELENIUM_TEST_WHITELIST', 'white');

define('SELENIUM_TEST_NOT_ON_BLACKLIST', 'black');
 
class IsolatedCheckoutPagesTest extends PHPUnit_Extensions_SeleniumTestCase
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
	
	public $paypalSelenium = '';
	
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
		
		
		// setup sandbox paypal credentials
		$this->paypalSelenium = new PaypalSelenium(array(
			'sandbox' => array(
				'login_email' => 'developer@ombi60.com',
				'login_password' => 'd3v31234',
				'customer_email' => 'shopper_sg@gmail.com',
				'customer_password' => 'customer'
			)
		));
		
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
		
		// GIVEN we have logged in to Sandbox Paypal
		$this->paypalSelenium->loginToSandbox($this);
		
		// AND we are at checkout page 1 aka carts view action ie https://checkout.ombi60.localhost/carts/2/4e895a91-b374-4a1a-947c-0b701507707a
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
		
		// WHEN we login to pay for the item at sandbox paypal
		$this->paypalSelenium->loginToPayAtSandbox($this);
		
		// THEN we reach the success page
		$this->assertLocation('regexp:' . $this->baseCheckoutUrl . 'orders/2/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/completed');
		
	}

 
    
}
?>