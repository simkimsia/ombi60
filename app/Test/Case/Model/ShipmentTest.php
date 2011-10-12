<?php
/* Order Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('Shipment', 'Model');

/**
 * Order Test Case
 *
 */
class ShipmentTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.cart', 'app.customer', 'app.shop', 
		'app.merchant', 'app.order', 'app.address', 
		'app.product', 'app.product_image', 'app.order_line_item', 
		'app.webpage', 'app.wishlist', 'app.cart_item', 
		'app.page_type', 'app.user', 'app.group',
		'app.variant', 'app.variant_option', 'app.products_in_group',
		'app.product_group', 'app.shop_setting', 'app.domain', 
		'app.casual_surfer', 'app.link_list', 'app.link', 
		'app.blog', 'app.post', 'app.comment', 
		'app.shops_payment_module', 'app.log', 'app.saved_theme',
		'app.vendor', 'app.country', 'app.shipped_to_country',
		'app.shipment', 'app.shipping_rate', 'app.price_based_rate',
		'app.weight_based_rate',
	);


/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Shipment = ClassRegistry::init('Shipment');
		
		// setting up Shop and User singleton
		$this->Shop 	= ClassRegistry::init('Shop');
		$this->User 	= ClassRegistry::init('User');
		
		$cachedShopId = Shop::get('Shop.id');
		
		if ($cachedShopId != 2) {
			$testShop = $this->Shop->getById(2);
			Shop::store($testShop);
		}
		
		$cachedUserId = User::get('User.id');
		
		if($cachedUserId != 2) {
			User::store($this->User->read(null, 2));
		}
		// this is to allow User singleton to work properly
		// look at AppController beforeFilter
		Configure::write('run_test', true);
		
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Shipment);
		unset($this->Shop);
		unset($this->User);
		ClassRegistry::flush();

		parent::tearDown();
	}
	
	
	/**
	*
	* test the getOptionsForCheckout method
	*
	**/
	public function testGetOptionsForCheckoutShouldGrabRelevantOptions() {
		//GIVEN that the following we want to buy goods weighing 15kg, $23 and shipped to Singapore
		$shippedAmount 	= 23.00;
		$shippedWeight 	= 15000;
		$shop_id		= 2;
		$country		= 192;
		
		// WHEN we run the method
		$actualOptions = $this->Shipment->getOptionsForCheckout($shippedAmount, $shippedWeight, $shop_id, $country);

		// THEN we get back 1 price based and 1 weight based rate as follows
		$expectedOptions = array(
			'3'	=> 'Standard Shipping - $10.00',
			'7'	=> 'Standard Shipping Price-based - $5.00',
		);		
		$this->assertEquals($expectedOptions, $actualOptions);
	}

	/**
	*
	* test the getPriceFromDisplayName method
	*
	**/	
	public function testGetPriceFromDisplayNameShouldExtractPrice() {
		// GIVEN we have just this shipment option display name
		$displayName 	= 'Standard Shipping - $10.00';
		
		// WHEN we run the getPriceFromDisplayName
		$actualPrice 	= $this->Shipment->getPriceFromDisplayName($displayName);

		// THEN we get back 10.00
		$expectedPrice	= '10.00';
		$this->assertEquals($expectedPrice, $actualPrice);
	}


	
}
