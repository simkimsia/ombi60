<?php
/* User Test cases generated on: 2010-04-21 11:04:41 : 1271849081*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.merchant', 'app.shop', 'app.customer', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.webpage', 'app.page_type', 'app.user', 'app.group',);

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}
	
	/**
	 * the function tested here is actually inside the app_model
	 * so we just test once here. and its sufficient. no need to test repeatedly.
	 *
	 * the identicalFieldValue is a custom validator function
	 *
	 * by default any functions placed inside the app_model will be tested here
	 **/
	function testIdenticalFieldValue() {
		
		$this->User->validate = array(
						'originalField' => array(
		
							'compare' => array(
								'rule' => array('identicalFieldValues', 'compareField' ), 
								'message' => 'error message',
								
							),
		
		
						),
					);
		
		$this->User->set(array('originalField' => 'abc', 'compareField' => 'abc'));
		$this->assertTrue($this->User->validates());
		
		$this->User->set(array('originalField' => 'abc', 'compareField' => 'axc'));
		$this->assertFalse($this->User->validates());
		

	}
	
	
	
	

}
?>