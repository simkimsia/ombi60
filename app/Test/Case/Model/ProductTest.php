<?php
/* Product Test cases generated on: 2011-09-22 09:42:11 : 1316684531*/
App::uses('Product', 'Model');
App::uses('Shop', 'Model');

/**
 * Product Test Case
 *
 */
class ProductTestCase extends CakeTestCase {
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

		$this->Product 	= ClassRegistry::init('Product');
		$this->Shop 	= ClassRegistry::init('Shop');
		
		$cachedShopId = Shop::get('Shop.id');
		
		if ($cachedShopId != 2) {
			$testShop = $this->Shop->getById(2);
			Shop::store($testShop);
		}
		
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Product);
		unset($this->Shop);
		ClassRegistry::flush();
		
		// consider running cake shell code to destroy image file and thumbs

		parent::tearDown();
	}
	
	/**
	* contains the list of assert statements that check the aftermath of $this->Product->duplicate
	* this checks primarily the Product data 
	**/
	private function checkProductDuplicateResult($duplicateProduct, $expectedId) {
		

		$expectedProduct = array(
			'Product' => array(
				'id' => 4,
				'shop_id' => 2,
				'title' => 'Dummy Product',
	            'code' => '',
	            'description' => '',
	            'price' => '11.0000',
	            'created' => '2011-09-28 17:06:24',
	            'modified' => '2011-09-28 17:06:24',
	            'visible' => true,
	            'weight' => 7000,
	            'currency' => 'SGD',
	            'shipping_required' => true,
	            'vendor_id' => 1,
	            'handle' => 'dummy-product-1',
	            'product_type_id' => 1,
	            'url' => '/products/dummy-product-1',
	            'displayed_weight' => 7,
			)

		);
		
		if ($expectedId == 5) {
			$expectedProduct['Product']['id'] 				= $expectedId;
			$expectedProduct['Product']['title'] 			= 'test product with no pic and no collection';
			$expectedProduct['Product']['description'] 		= '<p>test</p>';
			$expectedProduct['Product']['price'] 			= '23.0000';
			$expectedProduct['Product']['weight'] 			= 15000;
			$expectedProduct['Product']['displayed_weight'] = 15.0;
			$expectedProduct['Product']['handle'] 			= 'test-product-with-no-pic-and-no-collection-1';
			$expectedProduct['Product']['url'] 				= '/products/test-product-with-no-pic-and-no-collection-1';
			$expectedProduct['Product']['product_type_id'] 	= 0;			
			$expectedProduct['Product']['vendor_id'] 		= 0;			
		}
	
		$fieldsExpectedToBeDifferent = array('modified', 'created');
	
		$resultProduct 		= $duplicateProduct['Product'];
		$expectedProduct	= $expectedProduct['Product'];
	
		// check that these 2 fields exist
		$this->assertArrayHasKey('modified', $resultProduct);
		$this->assertArrayHasKey('created', $resultProduct);
		
		// check that the created and modified are not empty
		$this->assertNotEmpty($resultProduct['created']);
		$this->assertNotEmpty($resultProduct['modified']);
	
		// check that the other fields with EXACT field and values are expected
		foreach($fieldsExpectedToBeDifferent as $field) {

			unset($resultProduct[$field]);
			unset($expectedProduct[$field]);
		}
	
		$this->assertEquals($expectedProduct, $resultProduct);
		
	}
	
	/**
	 * contains the list of assert statements that check the $result = $this->Product->duplicate
	 **/
	private function checkImageDuplicateResult($resultFromDuplicateFunction, $gotPic = true) {
		if (!is_array($resultFromDuplicateFunction) && $gotPic) {
			$this->assertFalse($resultFromDuplicateFunction);
			return;
		}
		
		if ($gotPic == false) {
			$this->assertTrue($resultFromDuplicateFunction);
			return;
		}
		
		$expectedResultFromDuplicate = array(
			'ProductImage' => array(
				'product_id' => 4,
				'cover' => true,
				'dir' => 'uploads/products',
				'mimetype' => 'image/jpeg',
				'filesize' => 6103,
				'filename' => 'default-0-8.jpg', // different
				'modified' => '2011-09-28 17:06:24', // different
				'created' => '2011-09-28 17:06:24', // different
		            'id' => 3,
			)

		);
		
		$fieldsExpectedToBeDifferent = array('filename', 'modified', 'created');
		
		$resultProductImage 		= $resultFromDuplicateFunction['ProductImage'];
		$expectedResultProductImage	= $expectedResultFromDuplicate['ProductImage'];
		
		// check that these 3 fields exist
		$this->assertArrayHasKey('filename', $resultProductImage);
		$this->assertArrayHasKey('modified', $resultProductImage);
		$this->assertArrayHasKey('created', $resultProductImage);
		
		// check that the filename is expected
		$this->assertStringStartsWith('default-0', $resultProductImage['filename']);
		$this->assertStringEndsWith('.jpg', $resultProductImage['filename']);
		
		// now check if file and thumb exists
		if (isset($resultProductImage['filename'])) {
			$fileExists = file_exists(WWW_ROOT. $resultProductImage['dir'] . DS . $resultProductImage['filename']);
			$this->assertTrue($fileExists);
			
			$fileExists = file_exists(WWW_ROOT. $resultProductImage['dir'] . DS . 'thumb' . DS . 'icon' . DS . $resultProductImage['filename']);
			$this->assertTrue($fileExists);
			
			$fileExists = file_exists(WWW_ROOT. $resultProductImage['dir'] . DS . 'thumb' . DS . 'small' . DS . $resultProductImage['filename']);
			$this->assertTrue($fileExists);
			
			$fileExists = file_exists(WWW_ROOT. $resultProductImage['dir'] . DS . 'thumb' . DS . 'large' . DS . $resultProductImage['filename']);
			$this->assertTrue($fileExists);
			
			$fileExists = file_exists(WWW_ROOT. $resultProductImage['dir'] . DS . 'thumb' . DS . 'medium' . DS . $resultProductImage['filename']);
			$this->assertTrue($fileExists);
			
			$fileExists = file_exists(WWW_ROOT. $resultProductImage['dir'] . DS . 'thumb' . DS . 'thumb' . DS . $resultProductImage['filename']);
			$this->assertTrue($fileExists);
		}
		
		// check that the created and modified are not empty
		$this->assertNotEmpty($resultProductImage['created']);
		$this->assertNotEmpty($resultProductImage['modified']);
		
		// check that the other fields with EXACT field and values are expected
		foreach($fieldsExpectedToBeDifferent as $field) {

			unset($resultProductImage[$field]);
			unset($expectedResultProductImage[$field]);
		}
		
		$this->assertEquals($resultProductImage, $expectedResultProductImage);
		

	}


/**
 * testDuplicate method
 *
 * @return void
 */
	public function testDuplicate() {
		// first we duplicate Dummy Product which has 1 pic and belongs to 1 regular collection called Frontpage
		$result = $this->Product->duplicate('2'); // duplicate Dummy Product
		$this->checkImageDuplicateResult($result); // check image duplicate data and file
		
		// now we go find the duplicate and compare
		$dupeProductId 		= $this->Product->getLastInsertId();
		$duplicateProduct 	= $this->Product->read(null, $dupeProductId);
		
		$this->checkProductDuplicateResult($duplicateProduct, 4); // check Product data
		$count = $this->Product->ProductsInGroup->find('count', array(
			'conditions' => array(
				'ProductsInGroup.product_id' => 4,
				'ProductsInGroup.product_group_id' => 1)
		));
		
		// check product is in collection
		$this->assertEquals($count, 1);
		
		// now we test for another Product with no pics and no collections
		$result = $this->Product->duplicate('3'); // duplicate Dummy Product
		$this->checkImageDuplicateResult($result, false); // check image duplicate data and file
		
		// now we go find the duplicate and compare
		$dupeProductId 		= $this->Product->getLastInsertId();
		$duplicateProduct 	= $this->Product->read(null, $dupeProductId);

		$this->checkProductDuplicateResult($duplicateProduct, 5); // check Product data
		$count = $this->Product->ProductsInGroup->find('count', array(
			'conditions' => array(
				'ProductsInGroup.product_id' => 5,
				'ProductsInGroup.product_group_id' => 1)
		));
		
		// check product is NOT in collection. 
		$this->assertEquals($count, 0);
		
	}
	
	/**
	*
	* test createDetails Should work with Product and Variant -> VariantOption
	**/
	public function testCreateDetailsShouldWorkForImagelessProduct() {
		// GIVEN that we want to create an imageless Product
		$dataGiven = array(
			'Product' => array(
				'shop_id' => 2,
	            'title' => 'title1',
	            'description' => '<p>description</p>',
	            'code' => '',
	            'visible' => true,
	            'shipping_required' => true,
	            'currency' => 'SGD',
	            'price' => 12,
	            'displayed_weight' => 2,
	            'selected_collections' => array()
			),
			'Variant' => array(
				0 => array(
					'VariantOption' => array(
						0 => array(
							'field' => 'Title',
							'value' => 'Default Title',
							'order' => 0
						)
					)
				)
			)
		);
		 
		// WHEN we run the createDetails
		$result = $this->Product->createDetails($dataGiven);
		
		// THEN we expect success
		$this->assertTrue($result);
		
		// AND we find a new Product and Variant stored
		$result = $this->Product->find('first', array(
			'conditions' => array(
				'Product.id' => 4
			),
			'contain' => array(
				'Variant' => array(
					'fields' => array('Variant.id')
				)
			),
			'fields' => array('Product.id')
		));
		
		$this->assertEquals(4, $result['Product']['id']);
		$this->assertEquals(4, $result['Variant'][0]['id']);
	}
	
		
}
