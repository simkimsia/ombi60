<?php
/* Merchant Test cases generated on: 2011-09-22 09:56:50 : 1316685410*/
App::uses('Merchant', 'Model');

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
		'app.order', 'app.order_line_item', 'app.address', 
		'app.product', 'app.product_image', 'app.wishlist', 
		'app.variant', 'app.variant_option', 'app.products_in_group', 'app.product_group',  
		'app.product_type', 'app.vendor',
		'app.smart_collection_condition',
		'app.webpage', 'app.page_type', 
		'app.link_list', 'app.link', 
		'app.blog', 'app.post', 'app.comment', 
		'app.paypal_payment_module',
		'app.payment', 'app.shops_payment_module', 'app.payment_module',
		'app.log', 'app.saved_theme',
 		'app.country',
		'app.shipment', 'app.shipping_rate', 'app.shipped_to_country',	
		'app.price_based_rate', 'app.weight_based_rate'	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Merchant = ClassRegistry::init('Merchant');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Merchant);
		ClassRegistry::flush();

		parent::tearDown();
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

}
