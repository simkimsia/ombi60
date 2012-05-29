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
		'app.aro', 'app.aco', 'app.aros_aco',
		'app.shop',  'app.domain',
		'app.shop_setting', 'app.language',
		'app.user', 'app.group',
		'app.merchant', 'app.customer', 'app.casual_surfer',
		'app.cart', 'app.cart_item',
		'app.order', 'app.order_line_item', 'app.fulfillment', 'app.address', 
		'app.product', 'app.product_image', 'app.wishlist', 'app.custom_print', 
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
