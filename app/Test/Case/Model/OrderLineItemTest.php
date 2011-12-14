<?php
/* OrderLineItem Test cases generated on: 2011-09-22 09:56:50 : 1316685410*/
App::uses('OrderLineItem', 'Model');

/**
 * OrderLineItem Test Case
 *
 */
class OrderLineItemTestCase extends CakeTestCase {
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
	'app.order', 'app.order_line_item', 'app.address', 
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

		$this->OrderLineItem = ClassRegistry::init('OrderLineItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OrderLineItem);
		ClassRegistry::flush();

		parent::tearDown();
	}


	/**
	*
	* Test that Update all the prices, weights for all the orderLineItems associated with a particular variant
	*
	* @return void
	**/
	public function testUpdatePricesAndWeightsShouldUpdateProperly() {
		// GIVEN that we have two OrderLineItem that belongs to Product 3
		$count = $this->OrderLineItem->find('count', array(
			'conditions' => array(
				'OrderLineItem.variant_id' => 3
			)
		));
		$this->assertEquals(2, $count);
				
		// WHEN we update the price and weight for these 2 OrderLineItem
		$result = $this->OrderLineItem->updatePricesAndWeights(3, 22.00, 'SGD', 10000);
		
		// THEN we expect the result to be true
		$this->assertTrue($result);
		
		// AND we expect the values to change accordingly
		$cartItemFixture = new OrderLineItemFixture();
		$firstItem = $cartItemFixture->records[0];
		$thirdItem = $cartItemFixture->records[2];
		
		$this->OrderLineItem->recursive = -1;
		$actualItems = $this->OrderLineItem->find('all', array(
			'conditions' => array(
				'OrderLineItem.variant_id' => 3
			)
		));
		
		$firstItem['product_price'] 	= '22.0000';
		$firstItem['currency'] 			= 'SGD';
		$firstItem['product_weight'] 	= 10000;

		$thirdItem['product_price'] 	= '22.0000';
		$thirdItem['currency'] 			= 'SGD';
		$thirdItem['product_weight'] 	= 10000;
				
		$expectedItems = array(
			array('OrderLineItem' => $firstItem), 
			array('OrderLineItem' => $thirdItem)	
		);
		
		$this->assertEquals($expectedItems, $actualItems);

	}
}
