<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';


define('SELENIUM_TEST_ALL', 'all');

define('SELENIUM_TEST_WHITELIST', 'white');

define('SELENIUM_TEST_NOT_ON_BLACKLIST', 'black');
 
class IsolatedNormalPagesTest extends PHPUnit_Extensions_SeleniumTestCase
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
 
    
}
?>