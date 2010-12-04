<?php
/* Order Test cases generated on: 2010-04-17 12:04:00 : 1271507820*/
App::import('Model', 'Order');
require_once('app_model.test.php');

class OrderTestCase extends AppModelTestCase {
	

	function startTest() {
		$this->Order =& ClassRegistry::init('Order');
	}

	function endTest() {
		unset($this->Order);
		ClassRegistry::flush();
	}
	
	function testConvertCart() {
		// populate the options
		// set the customer, shop, billing addresses, etc
		$options = array();
		
		$options['billing_address_id'] = 1;
		$options['delivery_address_id'] = 1;
		$options['customer_id'] = 1;
		$options['shop_id'] = 1;
			
		// product 1 costs $2.3 buy 2 
		// product 2 costs $3.7 buy 3
		// check product_fixture.php for details
		$cartInSession = array(
				       1 => 2,
				       2 => 3,
				       );
		// convert the cart data to savable order data
		$data = $this->Order->convertCart($cartInSession, $options);
		
		// expected array
		$expected = array('Order' => array( 'shop_id' => 1,
						'customer_id' => 1,
						'billing_address_id' => 1,
						'delivery_address_id' => 1,
						'order_no' => '',
						'amount' => (2 * 2.3) + (3 * 3.7)
						),
					'OrderLineItem' => array());
		// product 1
		$expected['OrderLineItem'][] = array('product_id' => 1,
						'product_price' => 2.3,
						'product_quantity' => 2);
		
		// product 2
		$expected['OrderLineItem'][] = array('product_id' => 2,
						'product_price' => 3.7,
						'product_quantity' => 3);
		
		$this->assertEqual($expected, $data);
		
		// now we will attempt to save the data
		$this->assertTrue($this->Order->saveAll($data));
		
		// we expected the order_no to be 1001
		$this->assertEqual('1001', $this->Order->field('order_no', array('id'=>$this->Order->id)));
		
		// now we will attempt to save the data AGAIN
		$this->assertTrue($this->Order->saveAll($data));
		
		// we expected the order_no to be 1002
		$this->assertEqual('1002', $this->Order->field('order_no', array('id'=>$this->Order->id)));
		
	}

}
?>