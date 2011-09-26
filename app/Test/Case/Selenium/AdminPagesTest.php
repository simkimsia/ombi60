<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

define('SELENIUM_TEST_ALL', 'all');

define('SELENIUM_TEST_WHITELIST', 'white');

define('SELENIUM_TEST_NOT_ON_BLACKLIST', 'black');
 
class AdminPagesTest extends PHPUnit_Extensions_SeleniumTestCase
{
	
	public $localhost 				= true;
	public $url 					= 
		array(
			'localhost' => 'http://shop001.ombi60.localhost/',
			'production'=> 'http://');
								
	public $secondsBetweenCommands 	= 0;
	
	public $testRange = SELENIUM_TEST_ALL;
	
	public $whiteList = array('testProductsIndex');
	
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
	 * Test titles in public and admin site page
	**/
    public function testTitle() {
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
		//Testing public site
		$this->open('');
		$this->assertTitle('shop001 — Welcome');
		//Testing admin site
		$this->open('admin');
		$this->assertTitle('OMBI60: Open My Business in 60 Seconds: Merchant Login');
    }
    
	/**
	 * 
	 * Test admin login
	**/
    public function testLogin() {
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
    	$this->open('admin');
    	$this->type('id=UserEmail', 'owner@shop001.com');
    	$this->type('id=UserPassword', 'password');
    	$this->clickAndWait('css=input[type="submit"]');
    	$this->assertTitle('OMBI60: Open My Business in 60 Seconds: Merchants');
    }
    
	/**
	 * 
	 * Test Blog Index
	**/
    public function testBlogsIndex() {
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
    	$this->open('admin/blogs/');
    	$this->type('id=UserEmail', 'owner@shop001.com');
    	$this->type('id=UserPassword', 'password');
    	$this->clickAndWait('css=input[type="submit"]');
    	$this->assertElementPresent('//h2[text()=\'Blogs\']');
    	$this->assertElementPresent('css=div.blogs');
    	$this->assertElementPresent('link=New Blog');
    }

	/**
	 * 
	 * Test Product Index
	**/
    public function testProductsIndex() {
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
    	$this->open('admin/products/');
    	$this->type('id=UserEmail', 'owner@shop001.com');
    	$this->type('id=UserPassword', 'password');
    	$this->clickAndWait('css=input[type="submit"]');
    	$this->assertElementPresent('//h2[text()=\'Products\']');
    	$this->assertElementPresent('css=div.products');
    	$this->assertElementPresent('link=Add New Product');
    }

    
}
?>