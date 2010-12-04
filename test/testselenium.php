<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';
 
class WebTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://ombi60.localhost/');
    }
 
    public function testTitle()
    {
        $this->open('http://ombi60.localhost/');
        $this->assertTitle('\[Service Name\] - Home');
    }
    
    public function testAdminLogin() {
        $this->open('http://ombi60.localhost/admin');
        $this->verifyElementPresent('id=UserEmailzz');
        $this->verifyElementPresent('id=UserEmail');
        $this->assertElementPresent('id=UserEmail');
        $this->assertElementPresent('id=UserEmailxzz');
    }
}
?>