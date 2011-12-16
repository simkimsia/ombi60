<?php
/* Cart Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('CartItem', 'Model');

/**
 * CartItem Test Case
 *
 */
class CartItemTestCase extends CakeTestCase {
	/**
	 * Fixtures
	 *
	 * @var array
	 *
	 **/
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

		$this->CartItem = ClassRegistry::init('CartItem');
		
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
		unset($this->CartItem);
		unset($this->Shop);
		unset($this->User);
		ClassRegistry::flush();

		parent::tearDown();
	}
		
	
	/**
	 * testUpdatePricesAndWeightsShouldWork method
	 *
	 * @return void
	 *
	 **/
	public function testUpdatePricesAndWeightsShouldWork() {

		// GIVEN that we have two CartItem that belongs to Product 3
		$count = $this->CartItem->find('count', array(
			'conditions' => array(
				'CartItem.variant_id' => 3
			)
		));
		$this->assertEquals(2, $count);
				
		// WHEN we update the price and weight for these 2 CartItem
		$result = $this->CartItem->updatePricesAndWeights(3, 22.00, 'SGD', 10000);
		
		// THEN we expect the result to be true
		$this->assertTrue($result);
		
		// AND we expect the values to change accordingly
		$cartItemFixture = new CartItemFixture();
		$firstItem = $cartItemFixture->records[0];
		$thirdItem = $cartItemFixture->records[2];
		
		$this->CartItem->recursive = -1;
		$actualItems = $this->CartItem->find('all', array(
			'conditions' => array(
				'CartItem.variant_id' => 3
			)
		));
		
		$firstItem['product_price'] 	= '22.00';
		$firstItem['previous_price'] 	= '23.00';
		$firstItem['currency'] 			= 'SGD';
		$firstItem['previous_currency'] = 'SGD';
		$firstItem['product_weight'] 	= 10000;
		$firstItem['line_price']		= '22.0000';

		$thirdItem['product_price'] 	= '22.00';
		$thirdItem['previous_price'] 	= '23.00';
		$thirdItem['currency'] 			= 'SGD';
		$thirdItem['previous_currency'] = 'SGD';
		$thirdItem['product_weight'] 	= 10000;
		$thirdItem['line_price']		= '22.0000';
				
		$expectedItems = array(
			array('CartItem' => $firstItem), 
			array('CartItem' => $thirdItem)	
		);
		
		$this->assertEquals($expectedItems, $actualItems);
	}
	
	/**
	*
	* test setVariantIdAsKey should work
	*
	**/
	public function testSetVariantIdAsKeyShouldWork() {
		// GIVEN an array of CartItem data
		// WHEN we run function
		// THEN keys have been changed to variant id instead
	}
	
	/**
	*
	* test attachProductData should work
	*
	**/
	public function testAttachProductDataShouldWork() {
		// GIVEN an array of CartItem data
		// WHEN we run function
		// THEN keys have been changed to variant id instead
	}

}
