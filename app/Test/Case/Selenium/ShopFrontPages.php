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

    
}
?>