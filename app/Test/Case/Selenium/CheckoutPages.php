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
 
class CheckoutPagesTest extends PHPUnit_Extensions_SeleniumTestCase
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
		
		// get database config 
		$db_config = new DATABASE_CONFIG();
		$hostname = $db_config->default['host'];
		$database = $db_config->default['database'];
		$login = $db_config->default['login'];
		$password = $db_config->default['password'];
		
		R::setup('mysql:host='.$hostname.';dbname='.$database,$login,$password);
		
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