<?php
/* Cart Test cases generated on: 2011-09-22 09:25:06 : 1316683506*/
App::uses('User', 'Model');
App::uses('Shop', 'Model');
App::uses('Cart', 'Model');

/**
 * Cart Test Case
 *
 */
class CartTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.payment', 'app.shops_payment_module', 'app.payment_module',
		'app.log', 'app.saved_theme',
 		'app.country',
		'app.shipment', 'app.shipping_rate', 'app.shipped_to_country',	
		'app.price_based_rate', 'app.weight_based_rate'	
	);


/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Cart = ClassRegistry::init('Cart');
		
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
		unset($this->Cart);
		unset($this->Shop);
		unset($this->User);
		ClassRegistry::flush();

		parent::tearDown();
	}
	
	private function setUpForEmptyCart() {
		$this->Cart->query('TRUNCATE table `carts`');
		$this->Cart->query('TRUNCATE table `cart_items`');
		$this->User->id = 2;
		$this->User->saveField('live_cart_id', NULL);
		
		$noOfCarts = $this->Cart->find('count', array(
			'conditions' => array('Cart.user_id' => 2)
		));
		$this->assertEquals($noOfCarts, 0);
	}
	
	
	/**
	* 
	* we check for Cart Result where the Cart contains just 1 Item
	*
	* @param array $resultArray the actual result array
	* @param integer $expectedQuantity the quantity of the cart item bought
	* @return boolean
	**/
	private function check1ItemCartResult($resultArray, $expectedQuantity = 1) {
		App::uses('NumberLib', 'UtilityLib.Lib');
		$amount = NumberLib::precision(23.0000 * $expectedQuantity, 0);
		
		$expectedArray = array(
			'Cart' => array(
				'id' => '4e895a91-b374-4a1a-947c-0b701507707a',
	            'shop_id' => 2,
	            'user_id' => 2,
				'created' => '2011-10-03 06:47:45',
	            'amount' => $amount,
	            'status' => true,
	            'total_weight' => (15000 * $expectedQuantity),
	            'currency' => 'SGD',
	            'shipped_amount' => $amount,
	            'shipped_weight' => (15000 * $expectedQuantity),
	            'past_checkout_point' => false,
	            'cart_item_count' => 1,
	            'note' => NULL,
	            'attributes' => NULL,
	            'shipping_required' => 1,
			),
			'CartItem' => array(
				'0' => array(
					'id' => 1,
		            'cart_id' => '4e895a91-b374-4a1a-947c-0b701507707a',
		            'product_id' => 3,
                    'product_price' => 23,
                    'product_quantity' => $expectedQuantity,
                    'visible' => true,
                    'product_title' => 'test product with no pic and no collection',
                    'product_weight' => 15000,
                    'currency' => 'SGD',
                    'shipping_required' => true,
                    'previous_price' => 23,
                    'previous_currency' => 'SGD',
                    'variant_id' => 3,
                    'variant_title' => 'Default Title',
                    'line_price' => (23 * $expectedQuantity),
		        )
			)
	
		);		
		

		$this->expectedCartShouldMatchActualCart($expectedArray, $resultArray);
	
	}
	
	
	/**
	* 
	* we check for Cart Result where the Cart contains just 1 Item
	*
	* @param array $resultArray the actual result array
	* @param integer $expectedQuantity the quantity of the cart item bought
	* @return boolean
	**/
	private function check2ItemsWithImagesCartResult($resultArray) {
		
		$expectedArray = array(
			'Cart' => array(
				'id' => '4e9144d7-55e4-44a6-a2f1-1f721507707a',
	            'shop_id' => 2,
	            'user_id' => 3,
				'created' => '2011-10-03 06:47:45',
	            'amount' => '34.0000',
	            'status' => true,
	            'total_weight' => 22000,
	            'currency' => 'SGD',
	            'shipped_amount' => '34.0000',
	            'shipped_weight' => 22000,
	            'past_checkout_point' => false,
	            'cart_item_count' => 2,
	            'note' => NULL,
	            'attributes' => NULL,
	            'shipping_required' => 1,
			),
		    'CartItem' => array(
				'0' => array(
					'id' => 2,
					'cart_id' => '4e9144d7-55e4-44a6-a2f1-1f721507707a',
					'product_id' => 2,
					'product_price' => '11.00',
					'product_quantity' => 1,
					'visible' => true,
					'product_title' => 'Dummy Product',
					'product_weight' => 7000,
					'currency' => 'SGD',
					'shipping_required' => true,
					'previous_price' => 11.00,
					'previous_currency' => 'SGD',
					'variant_id' => 2,
					'variant_title' => 'Default Title',
					'line_price' => 11.0000,
					'CoverImage' => array(
						'id' => 2,
						'product_id' => 2,
						'cover' => true,
						'created' => '2011-07-08 11:54:47',
						'modified' => '2011-07-08 11:54:47',
						'filename' => 'default-0.jpg',
						'dir' => 'uploads/products',
						'mimetype' => 'image/jpeg',
						'filesize' => 6103
					)
		        ),
		
	            '1' => array(
					'id' => 3,
					'cart_id' => '4e9144d7-55e4-44a6-a2f1-1f721507707a',
					'product_id' => 3,
					'product_price' => 23,
					'product_quantity' => 1,
					'visible' => true,
					'product_title' => 'test product with no pic and no collection',
					'product_weight' => 15000,
					'currency' => 'SGD',
					'shipping_required' => true,
					'previous_price' => 23,
					'previous_currency' => 'SGD',
					'variant_id' => 3,
					'variant_title' => 'Default Title',
					'line_price' => 23,
					'CoverImage' => array(
		
                        'id' => NULL,
                        'product_id' => NULL,
                        'cover' => NULL,
                        'created' => NULL,
                        'modified' => NULL,
                        'filename' => NULL,
                        'dir' => NULL,
                        'mimetype' => NULL,
                        'filesize' => NULL
	                 )

	            )

			)
	
		);		
		
		$checkCartIdAsWell = true;
		$this->expectedCartShouldMatchActualCart($expectedArray, $resultArray, $checkCartIdAsWell);
	
	}
	
	/**
	*
	* comparison between expected Cart data and actual Cart data
	**/
	private function expectedCartShouldMatchActualCart($expectedArray, $resultArray, $checkCartId = false) {
		$fieldsExpectedToBeDifferent = array('created');
		if ($checkCartId == false) {
			$fieldsExpectedToBeDifferent[] = 'id';
		}


		$resultCart 	= $resultArray['Cart'];
		$expectedCart	= $expectedArray['Cart'];

		// check that these 2 fields exist
		$this->assertArrayHasKey('id', $resultCart);
		$this->assertArrayHasKey('created', $resultCart);

		// check that the created and modified are not empty
		$this->assertNotEmpty($resultCart['created']);
		$this->assertNotEmpty($resultCart['id']);

		// check that the other fields with EXACT field and values are expected
		foreach($fieldsExpectedToBeDifferent as $field) {

			unset($resultCart[$field]);
			unset($expectedCart[$field]);
		}


		$this->assertEquals($expectedCart, $resultCart);
		
		$fieldsExpectedToBeDifferent = array();
		if ($checkCartId == false) {
			$fieldsExpectedToBeDifferent = array('cart_id');
		}
		
		$resultCart 	= $resultArray['CartItem'];
		$expectedCart	= $expectedArray['CartItem'];

		// check that these 2 fields exist
		foreach($resultCart as $key=>$item) {
			$this->assertArrayHasKey('cart_id', $resultCart[$key]);

			// check that the created and modified are not empty
			$this->assertNotEmpty($resultCart[$key]['cart_id']);

			// check that the other fields with EXACT field and values are expected
			foreach($fieldsExpectedToBeDifferent as $field) {

				unset($resultCart[$key][$field]);
				unset($expectedCart[$key][$field]);
			}
			
			if (array_key_exists('CoverImage', $item)) {
				unset($resultCart[$key]['CoverImage']['created']);
				unset($expectedCart[$key]['CoverImage']['created']);
				unset($resultCart[$key]['CoverImage']['modified']);
				unset($expectedCart[$key]['CoverImage']['modified']);
			}
			
		}
		
		$this->assertEquals($expectedCart, $resultCart);
		
	}

/**
 * testMakeThisPrimary method
 *
 * @return void
 */
	public function testAddProductForCustomer() {

		// GIVEN that we have non existent carts for User 2
		$this->setUpForEmptyCart();
				
		// WHEN we add a product to non-existent cart for User 2
		$addToNonExistentCart = $this->Cart->addProductForCustomer(2, array(3=>1));
		
		// THEN we get back successful result
		$this->assertTrue($addToNonExistentCart);
		
		// AND cart is generated and item is inside
		$cart = $this->Cart->getLiveCartByUserId(2);
		$this->check1ItemCartResult($cart, 1);
		
		// WHEN we add another product for same customer
		$addToExistentCart = $this->Cart->addProductForCustomer(2, array(3=>1));
		
		// THEN we get back successful result
		$this->assertTrue($addToExistentCart);
		
		// AND cart now contains the 2nd item
		$cart = $this->Cart->getLiveCartByUserId(2);
		$this->check1ItemCartResult($cart, 2);
	}
	
/**
 * testChangeQuantityFor1Item method
 *
 * @return void
 */
	public function testChangeQuantityFor1Item() {

		// Given that we have non existent carts for User 2
		$this->setUpForEmptyCart();
		
		// WHEN we add a product to non-existent cart for User 2
		$addToNonExistentCart = $this->Cart->addProductForCustomer(2, array(3=>1));
		
		// THEN we get a true result for the adding
		$this->assertTrue($addToNonExistentCart);

		// AND the cart is properly updated
		$cart = $this->Cart->getLiveCartByUserId(2);
		$this->check1ItemCartResult($cart, 1);

		// WHEN we change the quantity for same product from 1 to 3 for User 2
		$addToExistentCart = $this->Cart->changeQuantityFor1Item(3, 3);
		$this->assertTrue($addToExistentCart);

		// THEN the cart is once again properly updated
		$cart = $this->Cart->getLiveCartByUserId(2);
		$this->check1ItemCartResult($cart, 3);
	}
	
/**
* 
* test editQuantities
**/
	public function testEditQuantities() {
		
		// Given that we have non existent carts for User 2
		$this->setUpForEmptyCart();

		// now we add a product to non-existent cart for User 2
		$addToNonExistentCart = $this->Cart->addProductForCustomer(2, array(3=>1));
		$this->assertTrue($addToNonExistentCart);

		$cart = $this->Cart->getLiveCartByUserId(2);
		$this->check1ItemCartResult($cart, 1);
		
		$_POST['updates'] = array(4);
		
		$result = $this->Cart->editQuantities();
		$this->assertTrue($result);
		
		$cart = $this->Cart->getLiveCartByUserId(2);
		$this->check1ItemCartResult($cart, 4);
	}
	
/**
* 
* test the getItemsWithImages should have a result array that looks like
* array(
*	'Cart' => array(....),
*	'CartItem' => array(
*		'0' => array(
*			'id' => 1,
*			'CoverImage' => array(
*				'id' => ..
*			)
*		)
*	)
* )
*
**/

	public function testGetItemsWithImagesShouldGrabResults() {
		// Given that we have 2 item in the Cart for User 3
		$cart_uuid = '4e9144d7-55e4-44a6-a2f1-1f721507707a';

		// WHEN we run getItemsWithImages
		$resultArray = $this->Cart->getItemsWithImages($cart_uuid);
		
		// THEN we expect the following result
		$this->check2ItemsWithImagesCartResult($resultArray);
		
	}
	
	/**
	*
	* closing the cart should work for open or live carts
	**/
	public function testCloseTheCartShouldCloseLiveCart() {
		$cartFixture = new CartFixture();
		$currentCart = $cartFixture->records[0];
		// Given that the cart currently is OPEN
		$this->assertEquals(0, $currentCart['past_checkout_point']);
		
		$cart_uuid = $currentCart['id'];
		
		// When we run the closeThisCart method
		$resultArray = $this->Cart->close($cart_uuid);

		// THEN the result returns an array
		$expectedArray = array(
			'Cart' => array(
				'past_checkout_point' => true
		    )
		);


		$this->assertEquals($expectedArray, $resultArray);
		
		// AND the cart is closed
		$this->Cart->id = $cart_uuid;

		$this->assertEquals(true, $this->Cart->field('past_checkout_point'));
		
	}
	
	/**
	*
	* test CloseTheCart should still return successful result even when the said cart is closed
	*
	**/
	public function testCloseTheCartShouldReturnTrueEvenWhenAlreadyClosed() {

		// GIVEN that the cart is already closed the function is idempotent
		$cart_uuid = '4e895a91-b374-4a1a-947c-0b701507707a';
		$this->Cart->id = $cart_uuid;
		$this->Cart->saveField('past_checkout_point', true);
		$this->assertTrue($this->Cart->field('past_checkout_point'));

		// WHEN we run closeTheCart despite the Cart being already closed
		$resultArray = $this->Cart->close($cart_uuid);

		// THEN the result returns an array
		$expectedArray = array(
			'Cart' => array(
				'past_checkout_point' => true
		    )
		);


		$this->assertEquals($expectedArray, $resultArray);
		
		// AND the cart remains closed
		$this->Cart->id = $cart_uuid;

		$this->assertEquals(true, $this->Cart->field('past_checkout_point'));
		
	}
	
	/**
	*
	* test the original getLiveCartByUserId only returns Cart, CartItem and a host of other models when we do a 
	* getLiveCartByUserId(2, true, true) this is for the display of Cart via Twig 
	*
	* the variant_id also becomes the key for cartitem
	**/
	public function testGetLiveCartByUserIdForCartTemplateShouldIncludeAssociatedModels() {
		// GIVEN we want to run getLiveCartByUserId for Cart Template
		
		
		// WHEN we run the function
		//$result = $this->Cart->getLiveCartByUserId(3, true, true);
		$result = $this->Cart->getLiveCartForCartTemplate(3);
		
		// THEN we get the following result		
		$this->assertTrue(!empty($result['Cart']));
		$this->assertTrue(!empty($result['CartItem']));
		$this->assertEqual(2, count($result['CartItem']));
		
		foreach($result['CartItem'] as $item) {
			$this->assertTrue(is_array($item['CheckedOutVariant']));
			$this->assertTrue(is_array($item['Product']));		
			$this->assertTrue(is_array($item['ProductImage']));			
			$this->assertTrue(is_array($item['ProductsInGroup']));
			$this->assertTrue(is_array($item['Variant']));			
			$this->assertTrue(is_array($item['Vendor']));			
		}
		
		// AND the variant ids are a match
		$expectedVariantIds = Set::extract('CartItem.{n}.variant_id', $result);
		$resultVariantIds = array_keys($result['CartItem']);
		
		$this->assertEquals($expectedVariantIds, $resultVariantIds);
		
	}
	
	/**
	*
	* test the original getLiveCartByUserId only returns Cart and CartItem 
	**/
	public function testGetLiveCartByUserIdShouldHaveOnlyCartAndCartItem() {
		// Given that we have non existent carts for User 2
		$this->setUpForEmptyCart();
		$userId = 2;
		$quantityAtLeastZero = 0;

		// WHEN we add a product to non-existent cart for User 2
		$addToNonExistentCart = $this->Cart->addProductForCustomer($userId, array(3=>1));
		$this->assertTrue($addToNonExistentCart);

		// THEN the getLiveCartByUserId works
		//$cart = $this->Cart->getLiveCartByUserId($userId, false, false);
		$cart = $this->Cart->getLiveCartByUserId($userId, $quantityAtLeastZero);
		$this->check1ItemCartResult($cart, 1);
	}
	
	/**
	*
	* test the original getLiveCartByUserId only returns Cart and CartItem and 
	* variant_id as the keys for the array
	*
	**/
	public function testGetLiveCartByUserIdShouldHaveDifferentVariantIdasKey() {
		// Given that we have non existent carts for User 2
		$this->setUpForEmptyCart();
		$userId = 2;
		$quantityAtLeastZero = 0;

		// WHEN we add a product to non-existent cart for User 2
		$addToNonExistentCart = $this->Cart->addProductForCustomer($userId, array(3=>1));
		$this->assertTrue($addToNonExistentCart);

		// AND the getLiveCartByUserId works with the variant id fixed as keys for CartItem array
		$result = $this->Cart->getLiveCartByUserId($userId, $quantityAtLeastZero);
		$result = $this->Cart->CartItem->setVariantIdAsKey($result);
		
		// THEN we expect the keys of the CartItem array to match the variant ids
		$expectedVariantIds = Set::extract('CartItem.{n}.variant_id', $result);
		$resultVariantIds = array_keys($result['CartItem']);
		
		$this->assertEquals($expectedVariantIds, $resultVariantIds);
	}
	
	/**
	*
	* When we change Product Price Weight, overall Cart Price Weight should change
	*
	**/
	public function testRecalculateShouldWorkForProductPriceWeightChange() {
		
	}

}
