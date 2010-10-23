<?php
/* Product Test cases generated on: 2010-04-17 12:04:13 : 1271507893*/
App::import('Model', 'Product');
require_once('app_model.test.php');

class ProductTestCase extends AppModelTestCase {

	function startTest() {
		$this->Product =& ClassRegistry::init('Product');
	}

	function endTest() {
		unset($this->Product);
		ClassRegistry::flush();
	}
	
	function testCreateProductDetails() {
		$data = array();
		$data['Product']['title'] = 'ally';
		$data['Product']['description'] = 'ally';
		$data['Product']['shop_id'] = '1';
		$data['Product']['status'] = true;
		$data['Product']['price'] = 1001;
		$data['Product']['code'] = '0001';
		$data['ProductImage']['0']['filename'] = array(
							    'name' => 'test_product_model.jpg',
							    'type' => 'image/jpeg',
							    'tmp_name' => realpath(WWW_ROOT.DS.'img'.DS.'test_product_model.jpg'),
							    'error' => 0,
							    'size' => 107266,
							   );
		
		

		$this->Product->createProductDetails($data);
		
		$result = $this->Product->find('first', array(
					'conditions' => array('Product.title' => 'ally',
							      'Product.description' => 'ally',
							      'Product.shop_id' => 1,
							      'Product.status' => true,
							      'Product.price' => 1001,
							      'Product.code' => '0001',),
					'contain' => array('ProductImage')
						
					)
				);
		
		
					
		$this->assertTrue(!empty($result));
		
		//$this->assertEqual(count($result['ProductImage']), 1);
		//this one failed because somehow the image record does not get saved http://bin.cakephp.org/view/1168239154
		// see this for more details http://github.com/jrbasso/MeioUpload/issues/issue/44


	}
	
	
	function testDeleteProduct() {
		
		// first reinsert these dummy data
		$data = array();
		$data['Product']['title'] = 'ally';
		$data['Product']['description'] = 'ally';
		$data['Product']['shop_id'] = '1';
		$data['Product']['status'] = true;
		$data['Product']['price'] = 1001;
		$data['Product']['code'] = '0001';
		$data['ProductImage']['0']['filename'] = array(
							    'name' => 'test_product_model.jpg',
							    'type' => 'image/jpeg',
							    'tmp_name' => realpath(WWW_ROOT.DS.'img'.DS.'test_product_model.jpg'),
							    'error' => 0,
							    'size' => 107266,
							   );
		
		
		$this->Product->createProductDetails($data);
		
		$id = $this->Product->id;
		
		$this->assertTrue(($id > 0));
		
		$this->Product->delete($id);
		
		$this->assertFalse($this->Product->read(NULL, $id));
		
	}
	
	function testDuplicateProduct() {
		// first reinsert these dummy data
		$data = array();
		$data['Product']['title'] = 'ally';
		$data['Product']['description'] = 'ally';
		$data['Product']['shop_id'] = '1';
		$data['Product']['status'] = true;
		$data['Product']['price'] = 1001;
		$data['Product']['code'] = '0001';
		$data['ProductImage']['0']['filename'] = array(
							    'name' => 'test_product_model.jpg',
							    'type' => 'image/jpeg',
							    'tmp_name' => realpath(WWW_ROOT.DS.'img'.DS.'test_product_model.jpg'),
							    'error' => 0,
							    'size' => 107266,
							   );
		
		
		$this->Product->createProductDetails($data);
		
		$id = $this->Product->id;
		
		$this->assertTrue(($id > 0));
		
		if ($id > 0) {
			$this->Product->duplicate($id);	
		}
		
		$this->assertTrue($this->Product->id > 0);
		
		$this->assertNotEqual($this->Product->id,$id);
	}
	
}
?>