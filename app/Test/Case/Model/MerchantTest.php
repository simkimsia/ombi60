<?php
/* Merchant Test cases generated on: 2011-09-22 09:56:50 : 1316685410*/
App::uses('Merchant', 'Model');
App::uses('AuthComponent', 'Component');

/**
 * Merchant Test Case
 *
 */
class MerchantTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.aro', 'app.aco', 'app.aros_aco',
		'app.shop',  'app.domain',
		'app.shop_setting', 'app.language',
		'app.user', 'app.group',
		'app.merchant', 'app.customer', 'app.casual_surfer',
		'app.cart', 'app.cart_item',
		'app.order', 'app.order_line_item', 'app.fulfillment', 'app.address', 
		'app.product', 'app.product_image', 'app.wishlist', 
		'app.variant', 'app.variant_option', 'app.products_in_group', 'app.product_group',  
		'app.product_type', 'app.vendor',
		'app.smart_collection_condition',
		'app.webpage', 'app.page_type', 
		'app.link_list', 'app.link', 
		'app.blog', 'app.post', 'app.comment', 
		'app.paypal_payment_module',
		'app.payment', 'app.shops_payment_module', 'app.payment_module',
		'app.log', 'app.saved_theme', 'app.theme',
 		'app.country',
		'app.shipment', 'app.shipping_rate', 'app.shipped_to_country',	
		'app.price_based_rate', 'app.weight_based_rate',
		'app.invoice', 'app.recurring_payment_profile',
		
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Merchant = ClassRegistry::init('Merchant');
		$this->Shop 	= ClassRegistry::init('Shop');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Merchant);
		unset($this->Shop);
		
		ClassRegistry::flush();

		parent::tearDown();
	}
	
	
/**
 * assert the valid Invoice data
 *
 * @return void
 */
	protected function assertValidInvoice($invoiceData) {
		$this->assertTrue(!empty($invoiceData['Invoice']['created']));
		$this->assertTrue(!empty($invoiceData['Invoice']['reference']));
		
		unset($invoiceData['Invoice']['created']);
		unset($invoiceData['Invoice']['reference']);
		
		$expected = array
		(
		    'Invoice' => array
		        (
		            'title' => 'starter',
		            'description' => 'Initial signup',
		            'shop_id' => '3',
		            'id' => 2
		        )

		);
		
		$this->assertEqual($expected, $invoiceData);
	}

/**
 * testUpdateProfile method
 *
 * @return void
 */
	public function testUpdateProfile() {
		//Verifying current data
		$merchant = $this->Merchant->read(null, '1');
		$expected = array(
			'Shop' => array(
				'name' => 'shop001',
				'url' => 'http://shop001.ombi60.localhost'
			),
			'User' => array(
				'email' => 'owner@shop001.com',
				'full_name' => 'Barry Allen'
			)
		);
		$this->assertEqual($merchant['Shop']['name'], $expected['Shop']['name']);
		$this->assertEqual($merchant['Shop']['url'], $expected['Shop']['url']);
		$this->assertEqual($merchant['User']['email'], $expected['User']['email']);
		$this->assertEqual($merchant['User']['full_name'], $expected['User']['full_name']);
		//Preparing data
		$merchantFixture = new MerchantFixture();
		$userFixture = new UserFixture();
		$shopFixture = new ShopFixture();
		$record['Merchant'] = $merchantFixture->records[0];
		$record['User'] = $userFixture->records[0];
		$record['Shop'] = $shopFixture->records[0];
		$record['Shop']['name'] = 'shop002';
		$record['Shop']['url'] = 'http://shop002.ombi60.localhost';
		$record['User']['email'] = 'merchant2@example.com';
		$record['User']['full_name'] = 'test user';
		$this->Merchant->updateProfile($record);
		$expected = array(
			'Shop' => array(
				'name' => 'shop002',
				'url' => 'http://shop002.ombi60.localhost'
			),
			'User' => array(
				'email' => 'merchant2@example.com',
				'full_name' => 'test user'
			)
		);
		$merchant = $this->Merchant->read(null, '1');
		$this->assertEqual($merchant['Shop']['name'], $expected['Shop']['name']);
		$this->assertEqual($merchant['Shop']['url'], $expected['Shop']['url']);
		$this->assertEqual($merchant['User']['email'], $expected['User']['email']);
		$this->assertEqual($merchant['User']['full_name'], $expected['User']['full_name']);
		
		
	}

/**
 * testRetrieveShopUserLanguageByUserId method
 *
 * @return void
 */
	public function testRetrieveShopUserLanguageByUserId() {
		$result = $this->Merchant->retrieveShopUserLanguageByUserId('1');
		$this->assertTrue(!empty($result));
		$this->assertTrue(!empty($result['Language']));
		$this->assertEqual($result['Language']['name'], 'English');
	}
	
	
/**
* test the signup function
*
* @return void
**/
	public function testSignupNewAccount() {
		// GIVEN that we want to sign up an account using paydollar sandbox Mastercard settings
		$data = array(
		'submit' => 'Submit',
	    'Shop' => array
	        (
	            'name' => 'shop017',
	            'primary_domain' => 'http://shop017.ombi60.localhost',
	            'subdomain' => 'shop017',
	            'email' => 'owner@shop017.com',
	            'url' => 'http://shop017.ombi60.localhost',
	            'permanent_domain' => 'shop017.ombi60.localhost'
	        ),

	    'User' => array
	        (
	            'full_name' => 'queenie',
	            'name_to_call' => 'queenie',
	            'email' => 'owner@shop017.com',
	            'password' => 'password',
	            'password_confirm' => 'password',
	        ),

	    'Merchant' => array
	        (
	            'theme_id' => 3
	        ),

	    'Paydollar' => array
	        (
	            'ccName' => 'queenie',
	            'ccNumber' => '5422882800700007',
	            'ccType' => 'Master',
	            'ccExpiry' => array
	                (
	                    'month' => '07',
	                    'year' => '2015',
	                )

	        ),

	    'Pay' => array
	        (
	            'method' => 'paydollar'
	        ),

	    'Invoice' => array
	        (
	            'title' => 'starter',
	            'description' => 'Initial signup',
	            'price' => '19.90',
	        )
		);
		
		// AND we need to ensure that the 3Cover Themed is removed
		$this->Merchant->Shop->FeaturedSavedTheme->deleteFolder('3Cover');
		
		// WHEN we run the signupNewAccount method
		$result = $this->Merchant->signupNewAccount($data);
		
		// THEN we expect the valid Invoice
		$this->assertValidInvoice($result);
		
		// AND shops has new data
		$shop = $this->Merchant->Shop->findByName('shop017');
		$this->assertTrue(!empty($shop));
		
		// AND merchants has new data
		$user = $this->Merchant->User->findByFullName('queenie');
		$this->assertTrue(!empty($user));
		$this->assertEqual(MERCHANTS, $user['User']['group_id']);
		
		$merchant = $this->Merchant->findByUserId($user['User']['id']);
		$this->assertTrue(!empty($merchant));
		$this->assertEqual(2, $merchant['Merchant']['id']);
		
		// AND we need to clean up by removing the test folder 3Cover
		$this->Merchant->Shop->FeaturedSavedTheme->deleteFolder('3Cover');
	}
	
/**
*
* checks if the checkMerchantForLogin returns the true if correct shop and login credentials
*
* @return void
**/
	public function testMerchantLoginShouldReturnTrue() {
		// GIVEN correct shop and login credentials
		$cachedShopId = Shop::get('Shop.id');
		
		if ($cachedShopId != 2) {
			$testShop = $this->Shop->getById(2);
			Shop::store($testShop);
		}
		
		$email		= 'owner@shop001.com';
		$password	= 'password';
		
		// WHEN we run the login
		$result = $this->Merchant->checkMerchantForLogin(2, $email, $password);
		
		// THEN it should be true
		$this->assertTrue($result);
		
	}
	
	/**
	*
	* checks if the checkMerchantForLogin returns the true if correct shop and login credentials
	*
	* @return void
	**/
		public function testMerchantLoginShouldReturnFalse() {
			// GIVEN correct shop and login credentials
			$cachedShopId = Shop::get('Shop.id');

			if ($cachedShopId != 2) {
				$testShop = $this->Shop->getById(2);
				Shop::store($testShop);
			}

			$email		= 'owner@shop002.com';
			$password	= 'password';

			// WHEN we run the login
			$result = $this->Merchant->checkMerchantForLogin(2, $email, $password);

			// THEN it should be true
			$this->assertFalse($result);

		}

}
