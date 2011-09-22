<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
 
class WebTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp() {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://shop001.ombi60.localhost/');
    }
 
    public function testTitle() {
		//Testing public site
		$this->open('http://shop001.ombi60.localhost/');
		$this->assertTitle('shop001 — Welcome');
		//Testing admin site
		$this->open('http://shop001.ombi60.localhost/admin');
		$this->assertTitle('OMBI60: Open My Business in 60 Seconds: Merchant Login');
    }
    
    public function testLogin() {
    	$this->open('http://shop001.ombi60.localhost/admin');
    	$this->type('id=UserEmail', 'owner@shop001.com');
    	$this->type('id=UserPassword', 'password');
    	$this->clickAndWait('css=input[type="submit"]');
    	$this->assertTitle('OMBI60: Open My Business in 60 Seconds: Merchants');
    }
    
}
?>