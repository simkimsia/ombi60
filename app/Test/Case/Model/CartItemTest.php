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
	*
	**/
	public function testSetVariantIdAsKeyShouldWork() {
		// GIVEN an array of CartItem data
		$data = array(
			'CartItem' => array(
				0 => array(
					'id' => 1,
					'product_title'	=> 'test product with no pic and no collection',
					'product_id'		=> 3,
					'variant_id'		=> 3,
				),
				1 => array(
					'id' => 2,
					'product_title'	=> 'Dummy Product',
					'product_id'		=> 2,
					'variant_id'		=> 2,					
				)
			)
		);
		
		// WHEN we run the setVariantIdAsKey
		$result = $this->CartItem->setVariantIdAsKey($data);
		
		// THEN we expect
		$expectedResult = array(
			'CartItem' => array(
				3 => array(
					'id' => 1,
					'product_title'	=> 'test product with no pic and no collection',
					'product_id'		=> 3,
					'variant_id'		=> 3,
				),
				2 => array(
					'id' => 2,
					'product_title'	=> 'Dummy Product',
					'product_id'		=> 2,
					'variant_id'		=> 2,
				)
			)
		);
		
		$this->assertEquals($expectedResult, $result);
	}
	
	/**
	*
	* test attachProductData should work
	*
	**/
	public function testAttachProductDataShouldWork() {
		// GIVEN an array of CartItem data
		$data = array(
			'CartItem' => array(
				0 => array(
					'product_id'	=> 2,
					'variant_id'	=> 2
				),
				1 => array(
					'product_id'	=> 3,
					'variant_id'	=> 3
				),
			)
		);
		
		// WHEN attachProductData
		$result = $this->CartItem->attachProductData($data);
		
		// THEN we expect the following
		$expectedResult = array(
			'CartItem' => array(
				(int) 0 => array(
					'product_id' => (int) 2,
					'variant_id' => (int) 2,
					'Product' => array(
						'id' => '2',
						'shop_id' => '2',
						'title' => 'Dummy Product',
						'code' => '',
						'description' => '',
						'price' => '11.0000',
						'created' => '2011-07-08 11:54:47',
						'modified' => '2011-07-08 11:54:47',
						'visible' => true,
						'weight' => '7000',
						'currency' => 'SGD',
						'shipping_required' => true,
						'vendor_id' => '1',
						'handle' => 'dummy-product',
						'product_type_id' => '1',
						'url' => '/products/dummy-product',
						'displayed_weight' => '7.0',
						'selected_collections' => array(
							(int) 0 => '1',
							(int) 1 => '2'
						)
					),
					'ProductImage' => array(
						(int) 0 => array(
							'filename' => 'default-0.jpg',
							'product_id' => '2'
						)
					),
					'ProductsInGroup' => array(
						(int) 0 => array(
							'id' => '1',
							'product_id' => '2',
							'product_group_id' => '1',
							'ProductGroup' => array(
								'id' => '1',
								'title' => 'Frontpage',
								'handle' => 'frontpage',
								'description' => null,
								'visible_product_count' => '1',
								'vendor_count' => '0',
								'url' => '/product_groups/frontpage'
							)
						),
						(int) 1 => array(
							'id' => '2',
							'product_id' => '2',
							'product_group_id' => '2',
							'ProductGroup' => array(
								'id' => '2',
								'title' => 'smart collection 1',
								'handle' => 'smart-collection-1',
								'description' => '<p>more than 1 dollar</p>',
								'visible_product_count' => '2',
								'vendor_count' => '0',
								'url' => '/product_groups/smart-collection-1'
							)
						)
					),
					'Variant' => array(
						(int) 0 => array(
							'id' => '2',
							'title' => 'Default Title',
							'product_id' => '2',
							'sku_code' => null,
							'weight' => '7000',
							'created' => '2011-07-08 11:54:47',
							'modified' => '2011-07-08 11:54:47',
							'currency' => 'SGD',
							'shipping_required' => true,
							'price' => '11.0000',
							'order' => '0',
							'compare_with_price' => null,
							'VariantOption' => array(
								(int) 0 => array(
									'id' => '2',
									'value' => 'Default Title',
									'field' => 'title',
									'variant_id' => '2'
								)
							)
						)
					),
					'Vendor' => array(
						'id' => '1',
						'title' => 'OMBI60'
					)
				),
				(int) 1 => array(
					'product_id' => (int) 3,
					'variant_id' => (int) 3,
					'Product' => array(
						'id' => '3',
						'shop_id' => '2',
						'title' => 'test product with no pic and no collection',
						'code' => '',
						'description' => '<p>test</p>',
						'price' => '23.0000',
						'created' => '2011-09-29 02:26:59',
						'modified' => '2011-09-29 02:26:59',
						'visible' => true,
						'weight' => '15000',
						'currency' => 'SGD',
						'shipping_required' => true,
						'vendor_id' => '0',
						'handle' => 'test-product-with-no-pic-and-no-collection',
						'product_type_id' => '0',
						'url' => '/products/test-product-with-no-pic-and-no-collection',
						'displayed_weight' => '15.0',
						'selected_collections' => array(
							(int) 0 => '2'
						)
					),
					'ProductImage' => array(),
					'ProductsInGroup' => array(
						(int) 0 => array(
							'id' => '3',
							'product_id' => '3',
							'product_group_id' => '2',
							'ProductGroup' => array(
								'id' => '2',
								'title' => 'smart collection 1',
								'handle' => 'smart-collection-1',
								'description' => '<p>more than 1 dollar</p>',
								'visible_product_count' => '2',
								'vendor_count' => '0',
								'url' => '/product_groups/smart-collection-1'
							)
						)
					),
					'Variant' => array(
						(int) 0 => array(
							'id' => '3',
							'title' => 'Default Title',
							'product_id' => '3',
							'sku_code' => '',
							'weight' => '15000',
							'created' => '2011-09-29 02:26:59',
							'modified' => '2011-09-29 02:26:59',
							'currency' => 'SGD',
							'shipping_required' => true,
							'price' => '23.0000',
							'order' => '0',
							'compare_with_price' => null,
							'VariantOption' => array(
								(int) 0 => array(
									'id' => '3',
									'value' => 'Default Title',
									'field' => 'Title',
									'variant_id' => '3'
								)
							)
						)
					),
					'Vendor' => array(
						'id' => null,
						'title' => null
					)
				)
			)
		);
		
		$this->assertEquals($expectedResult, $result);
	}

}
