<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

define('SELENIUM_TEST_ALL', 'all');

define('SELENIUM_TEST_WHITELIST', 'white');

define('SELENIUM_TEST_NOT_ON_BLACKLIST', 'black');
 
class AdminPagesTest extends PHPUnit_Extensions_SeleniumTestCase
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
			$this->baseUrl = $this->domains['localhost'];
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

	/**
	 *
	 * This replaces the OrdersController test for Redirect for create_order action
	 *
	 *
	**/
	public function testOrdersControllerCreateActionShouldRedirectToPayIfSuccessful() {
		if ($this->doNotRunThisTest(__FUNCTION__)) {
			return;
		}
		
		// GIVEN at checkout page 1 aka carts view action
		$this->open('carts/2/4e895a91-b374-4a1a-947c-0b701507707a');
		
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
		$this->assertLocation('regexp:' . $this->baseUrl . 'orders/2/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/pay');
	}


    
}
?>