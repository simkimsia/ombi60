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
	public $fixtures = array('app.product', 'app.saved_theme', 'app.user', 'app.shop_setting', 'app.shop', 'app.domain',
	'app.link', 'app.link_list', 'app.vendor', 'app.product_type', 'app.product_image', 'app.variant',
	'app.variant_option', 'app.log', 'app.products_in_group', 'app.product_group', 'smart_collection_condition',
	'app.blog', 'app.post', 'app.comment', 'app.webpage');
	
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

		parent::tearDown();
	}

/**
 * testDuplicate method
 *
 * @return void
 */
	public function testDuplicate() {
		$result = $this->Product->duplicate('2'); // duplicate Dummy Product
		$this->Product->log($result);
//		$this->assertTrue($result); // presumably if this works, we get back a boolean true
		// now we go find the duplicate and compare
		$dupeProductId 		= $this->Product->getLastInsertId();
		$duplicateProduct 	= $this->Product->read(null, $dupeProductId);
		$originalProduct	=  $this->Product->read(null, 2);
		
		
		$this->assertEquals($duplicateProduct, $originalProduct);
		
	}

}
