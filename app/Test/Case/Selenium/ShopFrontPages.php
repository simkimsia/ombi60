<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

$currentDirectory = dirname(__FILE__);
require_once $currentDirectory . '/../../../Vendor/PaymentSelenium/PaypalSelenium.php';

// include Redbean ORM
require_once $currentDirectory . '/../../../Vendor/RedBean/RedBean/redbean.inc.php';

// include Database in Config
require_once $currentDirectory . '/../../../Config/database.php';

define('SELENIUM_TEST_ALL', 'all');

define('SELENIUM_TEST_WHITELIST', 'white');

define('SELENIUM_TEST_NOT_ON_BLACKLIST', 'black');
 
class ShopFrontPagesTest extends PHPUnit_Extensions_SeleniumTestCase
{
	
	public $localhost 				= true;
	public $domains 				= 
		array(
			'localhost' => 'http://shop001.ombi60.localhost/',
			'production'=> 'http://');
								
	public $secondsBetweenCommands 	= 1;
	
	public $testRange = SELENIUM_TEST_ALL;
//	public $testRange = SELENIUM_TEST_WHITELIST;
//	public $testRange = SELENIUM_TEST_NOT_ON_BLACKLIST;
	
	
	public $whiteList = array('testHandleizeInDummyProduct');
	
	public $blackList = array();

	public $baseUrl  = '';
	
	public $baseCheckoutUrl = 'https://checkout.ombi60.localhost/';
	
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
	* Just to test that the TwigView is working 
	**/
	public function testTwigRunningWithIndex() {
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
		
		// GIVEN at index page for shop001
		$this->open('/');
		
		// THEN we see a Powered by hyperlink
		$this->assertElementPresent('xpath=//a[@href="http://www.openmybusinessin60seconds.com"][contains(text(), "Open My Business In 60 Seconds")]');
		
	}


	/**
	 *
	 * This replaces the OrdersController test for Redirect for create_order action
	 * TODO: This needs to be rewritten to cater for checkout pages with authentication purposes.
	 *

	public function testOrdersControllerCreateActionShouldRedirectToPayIfSuccessful() {
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
		
		// GIVEN at checkout page 1 aka carts view action
		$this->open($this->baseCheckoutUrl . 'carts/2/4e895a91-b374-4a1a-947c-0b701507707a');
		
		$this->assertElementPresent('xpath=//span[@class="font_bold"][contains(text(), "You are using our secure server")]');
		
		// WHEN we fill in the form correctly
		$this->type('id=UserEmail', 'guest_customer@ombi60.com');
		$this->type('id=BillingAddress0FullName', 'G. Cherry');
		$this->type('id=BillingAddress0Address', 'Billing Address St. Block 123 #01-911');
		$this->type('id=BillingAddress0City', 'Singapore');
		$this->type('id=BillingAddress0ZipCode', '11111');
		$this->select('id=BillingAddress0Country', 'label=Singapore');
		
		// AND submit to create_order action
		$this->assertElementPresent('xpath=//form[@action="/carts/2/4e895a91-b374-4a1a-947c-0b701507707a/create_order"]');
		$this->clickAndWait('css=input[type="submit"]');
		
		// THEN we should be redirected to pay action
		$this->assertLocation('regexp:' . $this->baseCheckoutUrl . 'orders/2/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/pay');
	}
	**/

    
}
?>