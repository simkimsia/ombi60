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
	*
	* test Product
	*
	* @param array Data array of result
	* @param integer $id Product id
	* @param boolean $visible We expect Product to be visible
	* @return void
	*
	**/
	private function checkProductResult($resultProduct, $id, $visible = true, $optionsIncluded = true) {
		if ($id == 2) {
			$expectedProduct = array(
				'Product' => array(
					'id' => '2',
					'shop_id' => '2',
					'title' => 'Dummy Product',
		            'code' => '',
		            'description' => '',
		            'price' => '11.0000',
		            'created' => '2011-09-28 17:06:24',
		            'modified' => '2011-09-28 17:06:24',
		            'visible' => $visible,
		            'weight' => '7000',
		            'currency' => 'SGD',
		            'shipping_required' => true,
		            'vendor_id' => '1',
		            'handle' => 'dummy-product',
		            'product_type_id' => '1',
		            'url' => '/products/dummy-product',
		            'displayed_weight' => '7.0',
					'options' => array(
						'title' => array(
							'values' => array(
								0 => 'Default Title',
							),
							'option_ids' => array(
								0 => 2
							),
							'values_in_string' => 'Default Title'
						)
					),
					'selected_collections' => array(
						0 => 1,
						1 => 2
					),
				)
			);
		} elseif ($id == 3) {
			$expectedProduct = array(
				'Product' => array(
					'id' => 3,
					'shop_id' => 2,					
					'title' => 'test product with no pic and no collection',
		            'code' => '',
		            'description' => '<p>test</p>',
		            'price' => '23.0000',
		            'created' => '2011-09-28 17:06:24',
		            'modified' => '2011-09-28 17:06:24',
		            'visible' => $visible,
		            'weight' => 15000,
		            'currency' => 'SGD',
		            'shipping_required' => true,
		            'vendor_id' => 0,
		            'handle' => 'test-product-with-no-pic-and-no-collection',
		            'product_type_id' => 0,
		            'url' => '/products/test-product-with-no-pic-and-no-collection',
		            'displayed_weight' => '15.0',
					'options' => array(
						'Title' => array(
							'values' => array(
								0 => 'Default Title',
							),
							'option_ids' => array(
								0 => 3
							),
							'values_in_string' => 'Default Title'
						)
					),
					'selected_collections' => array(
						0 => 2
					),
				)
			);			
		}
		
		$fieldsExpectedToBeDifferent = array('modified', 'created');
	
		$resultProduct 		= $resultProduct['Product'];
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
		
		if (!$optionsIncluded) {
			unset($expectedProduct['options']);
		}
	
		$this->assertEquals($expectedProduct, $resultProduct);
		
		
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
	* test smartUpdateProductsInGroup
	**/
	public function testSmartUpdateProductsInGroup() {
		// GIVEN we change Product 2 price into less than 1 dollar
		$this->Product->id = 2;
		$this->Product->save(array(
			'Product' => array(
				'price' => '0.10'
			)));
			
		$this->Product->recursive = -1;
		
		$product = $this->Product->read(null, 2);	
		
		// WHEN we run the smartupdate
		$result = $this->Product->smartUpdateProductsInGroup($product['Product']);
		
		// THEN we get success
		$this->assertTrue($result);
		
		// AND the ProductGroup 2 now has 3 products in all_product_count and visible_group_count
		$this->Product->ProductsInGroup->ProductGroup->id = 2;
		$visibleProduct = $this->Product->ProductsInGroup->ProductGroup->field('visible_product_count');
		$allProduct = $this->Product->ProductsInGroup->ProductGroup->field('all_product_count');		
		
		$this->assertEquals('1', $visibleProduct);
		$this->assertEquals('1', $allProduct);
			
		$result = $this->Product->ProductsInGroup->find('all', array(
			'conditions' => array(
				'product_id' => 2,
				'product_group_id' => 2
			)
		));
		
		// AND the association between ProductGroup 2 and Product 2 is no more
		$this->assertEquals(array(), $result);

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

	/**
	*
	* test createDetails Should work with Product and Variant -> VariantOption
	**/
	public function testCreateDetailsWorksWithCustomPrintData() {
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
	            'selected_collections' => array(),
				'custom_print_on' => 1,
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
		
		// AND we use the following file for test
		$fileName = 'test_custom_print.png';
		$pathToFile = dirname(dirname(dirname(__FILE__))) . DS . 'Fixture' . DS . 'File' . DS . $fileName;
		
		// AND we do not have this test file inside uploads/products/
		$webrootDir = APP . DS . 'webroot' . DS . 'uploads' . DS . 'products' . DS;		
		$webrootToFile = $webrootDir . 'test_custom_print.png';
		
		$file = new File($webrootToFile);
		$file->delete();
		
		// AND not in the thumb folders
		$webrootToFileThumbs = array(
			'thumb', 'icon', 'large', 'small', 'medium'
		);
		
		foreach($webrootToFileThumbs as $foldername) {
			$webrootToFile = $webrootDir . 'thumb' . DS . $foldername . DS . $fileName;
			$file = new File($webrootToFile);
			$file->delete();
		}
		
		
		// AND we turn the validate to false for checking uploaded_file for MeioUpload since we are using 
		// unit test, so we will definitely fail the validation for the is_uploaded_file
		$this->Product->ProductImage->validate['filename'] = array(
			'HttpPost' => array(
				'check' => false
			)
		);
		
		// AND we have the expected $_FILES
		$_FILES = array (
			'product_images' => array (
		            'name' => array ('0' => ''),
		            'type' => array ('0' => ''),
		            'tmp_name' => array ('0' => ''),
		            'error' => array ('0' => '4'),				
					'size'	=> array('0' => '0')
		     ),

		    'custom_print_image' => array(
		            'name' => 'test_custom_print.png',
		            'type' => 'image/png',
		           	'tmp_name' => $pathToFile,
		            'error' => 0,
		            'size' => 150396,
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
				),
				'CustomPrint' => array(
					'fields' => array('CustomPrint.id')
				),
				'ProductImage' => array(
					'fields' => array('ProductImage.id')
				),
			),
			'fields' => array('Product.id')
		));
		
		$this->assertEquals(4, $result['Product']['id']);
		$this->assertEquals(4, $result['Variant'][0]['id']);
		$this->assertEquals(1, $result['CustomPrint'][0]['id']);
		$this->assertEquals(3, $result['ProductImage'][0]['id']);
		
		// AND we need to delete away the test files
		$webrootToFile = $webrootDir . 'test_custom_print.png';
		
		$file = new File($webrootToFile);
		$file->delete();
		
		// AND in the thumb folders
		$webrootToFileThumbs = array(
			'thumb', 'icon', 'large', 'small', 'medium'
		);
		
		foreach($webrootToFileThumbs as $foldername) {
			$webrootToFile = $webrootDir . 'thumb' . DS . $foldername . DS . $fileName;
			$file = new File($webrootToFile);
			$file->delete();
		}
		
	}


	/**
	*
	* test createDetails Should work with Product and Variant -> VariantOption
	**/
	public function testCreateWillNotCustomPrintDataWhenOff() {
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
	            'selected_collections' => array(),
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
		
		// AND we use the following file for test
		$fileName = 'test_custom_print.png';
		$pathToFile = dirname(dirname(dirname(__FILE__))) . DS . 'Fixture' . DS . 'File' . DS . $fileName;
		
		// AND we do not have this test file inside uploads/products/
		$webrootDir = APP . DS . 'webroot' . DS . 'uploads' . DS . 'products' . DS;		
		$webrootToFile = $webrootDir . 'test_custom_print.png';
		
		$file = new File($webrootToFile);
		$file->delete();
		
		// AND not in the thumb folders
		$webrootToFileThumbs = array(
			'thumb', 'icon', 'large', 'small', 'medium'
		);
		
		foreach($webrootToFileThumbs as $foldername) {
			$webrootToFile = $webrootDir . 'thumb' . DS . $foldername . DS . $fileName;
			$file = new File($webrootToFile);
			$file->delete();
		}
		
		
		// AND we turn the validate to false for checking uploaded_file for MeioUpload since we are using 
		// unit test, so we will definitely fail the validation for the is_uploaded_file
		$this->Product->ProductImage->validate['filename'] = array(
			'HttpPost' => array(
				'check' => false
			)
		);
		
		// AND we have the expected $_FILES
		$_FILES = array (
			'product_images' => array (
		            'name' => array ('0' => ''),
		            'type' => array ('0' => ''),
		            'tmp_name' => array ('0' => ''),
		            'error' => array ('0' => '4'),				
					'size'	=> array('0' => '0')
		     ),

		    'custom_print_image' => array(
		            'name' => 'test_custom_print.png',
		            'type' => 'image/png',
		           	'tmp_name' => $pathToFile,
		            'error' => 0,
		            'size' => 150396,
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
				),
				'CustomPrint' => array(
					'fields' => array('CustomPrint.id')
				),
				'ProductImage' => array(
					'fields' => array('ProductImage.id')
				),
			),
			'fields' => array('Product.id')
		));
		
		$this->assertEquals(4, $result['Product']['id']);
		$this->assertEquals(4, $result['Variant'][0]['id']);
		$this->assertEquals(array(), $result['CustomPrint']);
		$this->assertEquals(array(), $result['ProductImage']);
		
		// AND we need to delete away the test files
		$webrootToFile = $webrootDir . 'test_custom_print.png';
		
		$file = new File($webrootToFile);
		$file->delete();
		
		// AND in the thumb folders
		$webrootToFileThumbs = array(
			'thumb', 'icon', 'large', 'small', 'medium'
		);
		
		foreach($webrootToFileThumbs as $foldername) {
			$webrootToFile = $webrootDir . 'thumb' . DS . $foldername . DS . $fileName;
			$file = new File($webrootToFile);
			$file->delete();
		}
		
	}

	
	/**
	*
	* test getDetails and getDetailsEvenHidden
	*
	**/
	public function testGetDetailsShouldWorkForVisibleProductOnly() {
		// GIVEN a visible Product
		$visible = $this->Product->find('count', array(
			'conditions' => array(
				'id' => 3,
				'Product.visible' => true
			),
		));
		$this->assertEquals(1, $visible);
		
		// AND a hidden Product
		$this->Product->toggle(2, 'visible');
		$hidden = $this->Product->find('count', array(
			'conditions' => array(
				'id' => 2,
				'Product.visible' => false
			),
		));
		$this->assertEquals(1, $hidden);
		
		// WHEN we run on both products
		$visibleResult = $this->Product->getDetails(3);
		$hiddenResult = $this->Product->getDetailsEvenHidden(2);
		$hiddenResultFalse = $this->Product->getDetails(2);
		
		$visibleExpected = true;
		$hiddenExpected = false;
		// THEN getDetails works for visible Products
		$this->checkProductResult($visibleResult, 3, $visibleExpected);	
		// AND getDetails fails for hidden Product
		$this->assertFalse($hiddenResultFalse);
		// AND getDetailsEvenHidden works for hidden prodcut
		$this->checkProductResult($hiddenResult, 2, $hiddenExpected);		
	}
	
	
	/**
	*
	* Rename the field names of the Options associated with Product
	* These will correctly impact on the VariantOptions model data
	**/
	public function testRenameOptionFieldsShouldWork() {
		// GIVEN we want to alter the Title field in VariantOption 3 into Size
		$options = array(
			'Title' => array(
				'new_field' => 'Size'
			)
		);
		
		$variants = array(3);
		
		// WHEN we run renameOptions
		$result = $this->Product->renameOptionFields($options, $variants);
		
		// THEN we get back success
		$this->assertTrue($result);
		
		// AND we have a renamed field
		$changedOption = $this->Product->Variant->VariantOption->read(null, 3);
		$expectedOption = array(
			'VariantOption' => array(
				'id' => 3,
				'variant_id' => 3,
				'field' => 'Size',
				'value' => 'Default Title',
				'order' => 0
			)
		);
		
		$this->assertEquals($expectedOption, $changedOption);
	}
	
	/**
	*
	* Delete all options
	**/
	public function testDeleteAllOptionsShouldWork() {
		// GIVEN we want to delete all Options for Title field and apply to VariantOption 3
		$options = array(
			'Title' => array()
		);
		
		$variants = array(3);
		
		// WHEN we run deleteAllOptions
		$result = $this->Product->deleteAllOptions($options, $variants);
		
		// THEN we get back success
		$this->assertTrue($result);
		
		// AND we no longer have that VariantOption
		$deletedOption = $this->Product->Variant->VariantOption->read(null, 3);
		$this->assertFalse($deletedOption);
	}
	

	/**
	*
	* Add new Product option
	**/
	public function testAddNewProductOptionShouldWork() {
		// GIVEN we want to add an Option for Size in Product 3
		$options = array(
			array(
				'field' => 'Size',
				'value' => 'Default Size',
			)
		);
		
		$productId = 3;
		
		$variants = array(3);
		
		// WHEN we run addNewProductOptions
		$result = $this->Product->addNewProductOptions($productId, $options, $variants);
		
		// THEN we get back success
		$this->assertTrue($result);
		
		// AND we have 2 VariantOptions for Variant 3
		$variant3 = $this->Product->Variant->VariantOption->find('all', array(
			'conditions' => array(
				'VariantOption.variant_id' => 3
			)
		));
		$expected = array(
			0 => array(
				'VariantOption' => array(
					'id' => 3,
					'variant_id' => 3,
					'field' => 'Title',
					'value' => 'Default Title',
					'order' => 0,
				)
			),
			
			1 => array(
				'VariantOption' => array(
					'id' => 4,
					'variant_id' => 3,
					'field' => 'Size',
					'value' => 'Default Size',
					'order' => 1,
				)
			)
		);
		
		$this->assertEquals($expected, $variant3);
	}
	
	/**
	*
	* test for the scenario where we add 2 new options and 1 is a custom option called stripes
	* and delete the old option Title
	**/
	public function testUpdateOptionsShouldWork() {
		// GIVEN we want to add 2 new options AND 1 is a custom option called stripes
		$newOptions = array(
			array(
				'field' => 'custom',
				'custom_field' => 'stripes',
				'value' => 'zebra'
			),
			array(
				'field' => 'Size',
				'value' => 'Default Size'
			)
		);
		// AND we want to delete the old option
		$currentOptions = array(
			'Title' => array(
				'delete' => true,
			)
		);
		
		$data = array(
			'Product' => array(
				'options' => $currentOptions,
				'new_options' => $newOptions,
				'id' => 3
			)
		);
		
		// WHEN we run the function
		$this->Product->updateOptions($data);
		
		// THEN we have 2 VariantOptions for Variant 3
		$variant3 = $this->Product->Variant->VariantOption->find('all', array(
			'conditions' => array(
				'VariantOption.variant_id' => 3
			)
		));
		$expected = array(
			0 => array(
				'VariantOption' => array(
					'id' => 4,
					'variant_id' => 3,
					'field' => 'stripes',
					'value' => 'zebra',
					'order' => 0,
				)
			),
			
			1 => array(
				'VariantOption' => array(
					'id' => 5,
					'variant_id' => 3,
					'field' => 'Size',
					'value' => 'Default Size',
					'order' => 1,
				)
			)
		);
		
		$this->assertEquals($expected, $variant3);
	}
	
	/**
	*
	* test for the scenario where we look up for next option order for Product 3
	**/
	public function testGetNextOptionOrderNoSHouldWork() {
		// GIVEN we use Product 3 with only 1 Option for Title
		$productId = 3;
		
		// WHEN we run the function
		$nextNo = $this->Product->getNextOptionOrder($productId);
		
		// THEN we expect 1
		$this->assertEquals(1, $nextNo);
	}
	
	/**
	*
	* test for the scenario where are given the full details of Product 3 and then we extract the Product Options
	**/
	public function testExtractProductOptionsFromDetailsShouldWork() {
		// GIVEN we use Product 3 with only 1 Option for Title
		$productId = 3;
		
		// AND we get full details of it
		$productDetails = $this->Product->getDetails(3);
		
		// WHEN we run the function
		$productOptions = $this->Product->extractProductOptionsFrom($productDetails);
		
		// THEN we expect the following
		$expected = array(
		    'Title' => array(
			 	'values' => array (
				 	0 => 'Default Title'
				),
				'option_ids' => array(
					0 => 3,
				),
				'values_in_string' => 'Default Title'
			)
		);
		
		$this->assertEquals($expected, $productOptions);
	}
	
	
	/**
	* 
	* test HandleMenuAction for delete
	**/
	public function testHandleMenuActionForDelete() {
		// GIVEN we want to delete 2 products of Shop 2
		$result = $this->Product->find('all', array(
			'conditions' => array(
				'shop_id' => 2
			)
		));
		
		$this->assertEquals(2, count($result));
		
		$data = array(
			'Product' => array(
				'selected' => array(2, 3),
				'menu_action' => 'Delete'
			)
		);
		
		// WHEN we run
		$result = $this->Product->handleMenuAction($data);
		
		// THEN we expect
		$expected = array(
			'message' => 'Selected products are successfully deleted',
		    'success' => true
		);
		
		$this->assertEquals($expected, $result);
		
		// AND no products for Shop
		$result = $this->Product->find('all', array(
			'conditions' => array(
				'shop_id' => 2
			)
		));
		
		$this->assertEquals(0, count($result));
	}

	/**
	* 
	* test HandleMenuAction for hide
	**/
	public function testHandleMenuActionForHide() {
		// GIVEN we want to hide 2 visible products of Shop 2
		$result = $this->Product->find('all', array(
			'conditions' => array(
				'shop_id' => 2,
				'visible' => true
			)
		));
		
		$this->assertEquals(2, count($result));
		
		$data = array(
			'Product' => array(
				'selected' => array(2, 3),
				'menu_action' => 'Hide'
			)
		);
		
		// WHEN we run
		$result = $this->Product->handleMenuAction($data);
		
		// THEN we expect
		$expected = array(
			'message' => 'Selected products are successfully hidden',
		    'success' => true
		);
		
		$this->assertEquals($expected, $result);
		
		// AND all hidden products for Shop
		$result = $this->Product->find('all', array(
			'conditions' => array(
				'shop_id' => 2,
				'visible' => false,
			)
		));
		
		$this->assertEquals(2, count($result));
		
	}

	/**
	* 
	* test HandleMenuAction for publish
	**/
	public function testHandleMenuActionForPublish() {
		// GIVEN we have 2 visible products of Shop 2
		$data = array(
			'Product' => array(
				'selected' => array(2, 3),
				'menu_action' => 'Hide'
			)
		);
		
		// AND we hide them
		$this->Product->handleMenuAction($data);
		
		$result = $this->Product->find('all', array(
			'conditions' => array(
				'shop_id' => 2,
				'visible' => false,
			)
		));
		
		$this->assertEquals(2, count($result));
		
		// WHEN we publish them
		$data = array(
			'Product' => array(
				'selected' => array(2, 3),
				'menu_action' => 'Publish'
			)
		);
		
		$result = $this->Product->handleMenuAction($data);
		
		// THEN we expect
		$expected = array(
			'message' => 'Selected products are successfully published',
		    'success' => true
		);
		
		$this->assertEquals($expected, $result);
		
		// AND all visible products for Shop
		$result = $this->Product->find('all', array(
			'conditions' => array(
				'shop_id' => 2,
				'visible' => true,
			)
		));
		
		$this->assertEquals(2, count($result));
		
	}
	
	/**
	*
	* test saveIntoCollections Should work for Product 3 into 2 separate groups Group1 and 2
	*
	**/
	public function testSaveIntoCollectionShouldWork() {
		// GIVEN we have 2 Product Groups
		$addIntoCollection = array(1, 3);
		
		// AND we have a Product that belongs to Zero Groups
		$productId = 3;
		
		// WHEN we do a saveIntoCollections
		$result = $this->Product->saveIntoCollections($productId, $addIntoCollection);
		
		// THEN we expect success
		$this->assertTrue($result);
		
		// AND we expect that Group 1 now has 2 product count
		$this->Product->ProductsInGroup->ProductGroup->id = 1;
		$visibleProduct = $this->Product->ProductsInGroup->ProductGroup->field('visible_product_count');
		$allProduct = $this->Product->ProductsInGroup->ProductGroup->field('all_product_count');		
		
		$this->assertEquals('2', $visibleProduct);
		$this->assertEquals('2', $allProduct);
		
		// AND Group 2 has 1 product count
		$this->Product->ProductsInGroup->ProductGroup->id = 3;
		$visibleProduct = $this->Product->ProductsInGroup->ProductGroup->field('visible_product_count');
		$allProduct = $this->Product->ProductsInGroup->ProductGroup->field('all_product_count');		
		
		$this->assertEquals('1', $visibleProduct);
		$this->assertEquals('1', $allProduct);
	}
	
	/**
	*
	* test formatCakeConditions works
	*
	**/
	public function testFormatCakeConditionShouldWork() {
		// GIVEN conditions for "equals":, starts_with, ends_with, contains, greater_than, less_than
		$field = 'price';
		$value = '10';
		
		$relations = array(
			'equals' => array($field => $value), 
			'starts_with' => array($field . " LIKE '".$value."%'"),
			'ends_with' => array($field . " LIKE '%".$value."'"),
			'contains' => array($field . " LIKE '%".$value."%'"),
			'greater_than' => array($field . " > "=> $value),
			'less_than' => array($field . " < "=> $value)
		);
		
		foreach($relations as $relation => $expectedValue) {
			$conditionalArray = array(
				'relation' => $relation,
				'field'	=> $field,
				'condition' => $value,
			);
			
			// WHEN we run the function
			$result = $this->Product->formatCakeConditions($conditionalArray);
			
			// THEN we get back the expected
			$this->assertEquals($expectedValue, $result);
		}
	}
	
	/**
	*
	* test updateCounterCacheForM2MMain works for Selected Groups 
	*
	**/
	public function testUpdateCounterCacheForM2MMainForGroups() {
		// GIVEN we want to remove the association between Product 2 and ProductGroup 2
		$result = $this->Product->ProductsInGroup->delete(2, false);
		
		$this->assertTrue($result);
		
		// AND ProductGroup 2 still has the incorrect count of 2
		$this->Product->ProductsInGroup->ProductGroup->id = 2;
		$visibleCountOf2 = $this->Product->ProductsInGroup->ProductGroup->field('visible_product_count');
		$allCountOf2 = $this->Product->ProductsInGroup->ProductGroup->field('all_product_count');
		
		$this->assertEquals(2, $visibleCountOf2);
		$this->assertEquals(2, $allCountOf2);
		
		// WHEN we run the updateCounterCacheForM2MMain
		$result = $this->Product->updateCounterCacheForM2MMain(2, array(1, 2));
		
		// THEN we get success results
		$this->assertTrue($result);
		
		// AND ProductGroup 2 now has the correct count of 1
		$this->Product->ProductsInGroup->ProductGroup->id = 2;
		$visibleCountOf2 = $this->Product->ProductsInGroup->ProductGroup->field('visible_product_count');
		$allCountOf2 = $this->Product->ProductsInGroup->ProductGroup->field('all_product_count');
		
		$this->assertEquals(1, $visibleCountOf2);
		$this->assertEquals(1, $allCountOf2);
		

	}
	
	public function testGetAllVisibleByShopShouldWork() {
		// GIVEN we want to use shop 2
		$shop_id = 2;
		
		// WHEN we run the function
		$result = $this->Product->getAllVisibleByShopId($shop_id);
		
		// THEN we should match the following data because we get in CREATED DESC order
		$this->checkProductResult($result[1], 2, true, false);
		$this->checkProductResult($result[0], 3, true, false);
	}

}
