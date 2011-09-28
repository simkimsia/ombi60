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
								
	public $secondsBetweenCommands 	= 1;
	
	public $testRange = SELENIUM_TEST_ALL;
//	public $testRange = SELENIUM_TEST_WHITELIST;
//	public $testRange = SELENIUM_TEST_NOT_ON_BLACKLIST;
	
	
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

	/**
	 *
	 * Test Handleize Plugin works
	**/
	public function testHandleizeInDummyProduct() {
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
		// go to products edit for dummy product
		$this->open('admin/products/edit/2');
		// login
		$this->type('id=UserEmail', 'owner@shop001.com');
    	$this->type('id=UserPassword', 'password');
    	$this->clickAndWait('css=input[type="submit"]');
		// change the handle for dummy product
		$this->assertElementPresent('css=input[type="text"][id="ProductHandle"][value="dummy-product"]');
    	$this->type('id=ProductHandle', 'dummy-productx123');
    	$this->clickAndWait('css=input[type="submit"][value="Update Product"]');
		// now we need to go back to edit page to test
		$this->assertElementPresent('xpath=//div[@id="flashMessage"][@class="flash_success"][contains(text(), "The Product has been saved")]');
		$this->open('admin/products/edit/2');
		// now we check 
		$this->assertElementPresent('css=input[type="text"][id="ProductHandle"][value="dummy-productx123"]');
		// change back
    	$this->type('id=ProductHandle', 'dummy-product');
    	$this->clickAndWait('css=input[type="submit"][value="Update Product"]');
		$this->assertElementPresent('xpath=//div[@id="flashMessage"][@class="flash_success"][contains(text(), "The Product has been saved")]');
	}
	
	
	/**
	 *
	 * Test Visible Plugin works
	**/
	public function testVisibleInDummyProduct() {
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
		// go to products index for dummy product
		$this->open('admin/products');
		// login
		$this->type('id=UserEmail', 'owner@shop001.com');
    	$this->type('id=UserPassword', 'password');
    	$this->clickAndWait('css=input[type="submit"]');
		$this->assertElementPresent('xpath=//a[@href="/admin/products/toggle/2"][@class="product-status"][contains(text(), "Published")]');
		// now we check if status has been changed from Published to Hidden
		$this->open('admin/products/toggle/2');
		$this->assertElementPresent('xpath=//div[@id="flashMessage"][@class="flash_success"][contains(text(), "Product status has been changed")]');
		$this->assertElementPresent('xpath=//a[@href="/admin/products/toggle/2"][@class="product-status"][contains(text(), "Hidden")]');
		
		// change back
		$this->open('admin/products/toggle/2');
		$this->assertElementPresent('xpath=//div[@id="flashMessage"][@class="flash_success"][contains(text(), "Product status has been changed")]');
		$this->assertElementPresent('xpath=//a[@href="/admin/products/toggle/2"][@class="product-status"][contains(text(), "Published")]');
	}
	
	
	/**
	 *
	 * Test that Hidden Product is still retrievable for products/edit
	**/
	public function testHiddenDummyProductIsEditable() {
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
		// go to products index for dummy product
		$this->open('admin/products');
		// login
		$this->type('id=UserEmail', 'owner@shop001.com');
    	$this->type('id=UserPassword', 'password');
    	$this->clickAndWait('css=input[type="submit"]');
		$this->assertElementPresent('xpath=//a[@href="/admin/products/toggle/2"][@class="product-status"][contains(text(), "Published")]');
		// now we check if status has been changed from Published to Hidden
		$this->open('admin/products/toggle/2');
		$this->assertElementPresent('xpath=//div[@id="flashMessage"][@class="flash_success"][contains(text(), "Product status has been changed")]');
		$this->assertElementPresent('xpath=//a[@href="/admin/products/toggle/2"][@class="product-status"][contains(text(), "Hidden")]');
		
		// the key assertion
		$this->open('admin/products/edit/2');
		$this->assertElementPresent('css=input[type="text"][id="ProductHandle"][value="dummy-product"]');
		
		// change back
		$this->open('admin/products/toggle/2');
		$this->assertElementPresent('xpath=//div[@id="flashMessage"][@class="flash_success"][contains(text(), "Product status has been changed")]');
		$this->assertElementPresent('xpath=//a[@href="/admin/products/toggle/2"][@class="product-status"][contains(text(), "Published")]');
	}


    
}
?>