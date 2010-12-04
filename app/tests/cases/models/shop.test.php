<?php
/* Shop Test cases generated on: 2010-04-17 12:04:24 : 1271507904*/
App::import('Model', 'Shop');

class ShopTestCase extends CakeTestCase {
	var $fixtures = array('app.shop', 'app.merchant', 'app.user', 'app.group', 'app.domain', 'app.customer', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.wishlist', 'app.webpage', 'app.page_type', );

	function startTest() {
		$this->Shop =& ClassRegistry::init('Shop');
	}

	function endTest() {
		unset($this->Shop);
		ClassRegistry::flush();
	}
	
	function testRegisterNewAccount() {
		$data = array();
		$data['User']['name_to_call'] = 'ally';
		$data['User']['full_name'] = 'ally';
		$data['User']['email'] = 'ally@a.com';
		$data['User']['password'] = 'password';
		$data['User']['password_confirm'] = 'password';
		$data['Shop']['web_address'] = 'http://abc.myspree2shop.com';
		$data['Shop']['subdomain'] = 'abc';
		
		$this->Shop->signupNewAccount($data);
		$result = $this->Shop->find('first', array(
					'conditions' => array('User.email' => 'ally@a.com',
							      'Shop.web_address' => 'http://abc.myspree2shop.com',
							      'Merchant.owner' => true,
							      'User.group_id' => MERCHANTS),
					
					));
		
		$this->assertTrue(!empty($result));
		
		$user_details = array();
		$shop_details = array();
		
		if (!empty($result)) {
			$user_details = array_intersect($result['User'], $data['User']);
			$shop_details = array_intersect($result['Shop'], $data['Shop']);
			
			// need to unset these 2 fields because they actually do NOT exist in the database
			// they appear on the forms for UI reasons
			unset($data['User']['password_confirm']);
			unset($data['Shop']['subdomain']);
		}
		
		$this->assertEqual($user_details, $data['User']);
		$this->assertEqual($shop_details, $data['Shop']);
		

	}

}
?>