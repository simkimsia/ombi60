<?php
App::uses('CustomPrint', 'Model');
App::uses('Product', 'Model');
App::uses('Shop', 'Model');

/**
 * CustomPrint Test Case
 *
 */
class CustomPrintTestCase extends CakeTestCase {
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
		$this->CustomPrint = ClassRegistry::init('CustomPrint');
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
		unset($this->CustomPrint);
		unset($this->Product);
		unset($this->Shop);
		

		parent::tearDown();
	}
	
	/**
	*
	* test for the scenario where we generate a new image for new words and return the filename of the new image
	**/
	public function testUpdateNewImage() {
		// GIVEN we have the test_rectangle_eng.jpg 
		$fileName = 'test_rectangle_eng.jpg';
		$pathToFile = dirname(dirname(dirname(__FILE__))) . DS . 'Fixture' . DS . 'File' . DS . $fileName;

		// AND we move it to www_root/uploads/products
		$destinationPath = PRODUCT_IMAGES_PATH . $fileName;
		
		$file = new File($pathToFile);
		$file->copy($destinationPath);
		
		$copyfile = new File($destinationPath);
		$this->assertTrue($copyfile->exists());
		
		// AND we prepare the data array
		$text = array(
			'value' => 'Yabba Dabba Doo'
		);
		
		$data = array(
			'CustomPrint' => array(
				'text' => $text
			)
		);
		
		// WHEN we run the function
		$result = $this->CustomPrint->updateNewImage($data, $fileName);
		
		// THEN we expect the files end with png
		$expected = '.png';
		
		$this->assertEquals($expected, substr($result, -4));
	}
	
	/**
	 * test the word wrap annotation
	 **/
	public function testWordWrapAnnotation() {
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
		//$result = $this->CustomPrint->wordWrapAnnotation($data);
		
		// THEN we expect the files end with png
		$expected = '.png';
		
		//$this->assertEquals($expected, $result);
	}
	

}
