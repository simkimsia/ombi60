<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

define('SELENIUM_TEST_ALL', 'all');

define('SELENIUM_TEST_WHITELIST', 'white');

define('SELENIUM_TEST_NOT_ON_BLACKLIST', 'black');
 
class IsolatedAdminPagesTest extends PHPUnit_Extensions_SeleniumTestCase
{
	
	public $localhost 				= true;
	public $url 					= 
		array(
			'localhost' => 'http://shop001.ombi60.localhost/',
			'production'=> 'http://');
								
	public $secondsBetweenCommands 	= 1;
	
	public $testRange = SELENIUM_TEST_ALL;	
	
	public $whiteList = array('testHandleizeInDummyProduct');
	
	public $blackList = array();
	
	
	/**
	 *
	 * Setup before running all the test cases
	**/
    protected function setUp() {
        $this->setBrowser('*firefox');

		if ($this->localhost) {
			$this->setBrowserUrl($this->url['localhost']);
		} else {
			$this->setBrowserUrl($this->url['production']);
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
	 * Duplicate Dummy Product. Tests MeioDuplicate as well.
	 *
	 *
	**/
	public function testDuplicateDummyProduct() {
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
		// go to products edit for dummy product
		$this->open('admin/products/edit/2');
		// login
		$this->type('id=UserEmail', 'owner@shop001.com');
    	$this->type('id=UserPassword', 'password');
    	$this->clickAndWait('css=input[type="submit"]');
		// check for Frontpage selected for Dummy Product
		$this->assertElementPresent('xpath=//input[type="checkbox"][id="ProductSelectedCollections1"][checked="checked"]');
		// now we duplicate this dummy product
		$this->open('admin/products/duplicate/2');
		// now we need to check for success message
		$this->assertElementPresent('xpath=//div[@id="flashMessage"][@class="flash_success"][contains(text(), "Product duplicated")]');
		$this->open('admin/products/edit/2');
		// now we check 
		$this->assertElementPresent('css=input[type="text"][id="ProductHandle"][value="dummy-productx123"]');
		// change back
    	$this->type('id=ProductHandle', 'dummy-product');
    	$this->clickAndWait('css=input[type="submit"][value="Update Product"]');
		$this->assertElementPresent('xpath=//div[@id="flashMessage"][@class="flash_success"][contains(text(), "The Product has been saved")]');
	}


 
    
}
?>