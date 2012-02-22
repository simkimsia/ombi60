<?php
/* Fulfillment Test cases generated on: 2012-02-18 08:50:52 : 1329555052*/
App::uses('Fulfillment', 'Model');

/**
 * Fulfillment Test Case
 *
 */
class FulfillmentTestCase extends CakeTestCase {
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

		$this->Fulfillment = ClassRegistry::init('Fulfillment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Fulfillment);

		parent::tearDown();
	}
	
/**
*
* testFulfillItems
*
* @return void
*/
	public function testFulfillItems() {
		
		// GIVEN we want to fulfill 1 of 2 items of order 
		$requestData = array(
			'Fulfillment' => array(
				'order_id' => '4e91458a-b0f8-452c-ab84-1d351507707a'
			),
			'OrderLineItem' => array(
				array('id' => '2'),
				array('id' => '0')
			)
		);
		
		// WHEN we actually run the fulfillment
		$this->Fulfillment->fulfillItems($requestData);
		
		// THEN we expect to see the status of order changed to partial
		$count = $this->Fulfillment->Order->find('count', array(
			'conditions' => array(
				'id' 					=> $requestData['Fulfillment']['order_id'],
				'fulfillment_status'	=> FULFILLMENT_PARTIAL
			)
		));
		
		$expectOne = 1;
		$this->assertEquals($expectOne, $count);
		
		// AND we expect to see a new fulfillment created for Order
		$allFulfillments = $this->Fulfillment->find('all', array(
			'conditions' => array(
				'order_id' 		=> $requestData['Fulfillment']['order_id']
			)
		));
		
		$expectOne = 1;
		$this->assertEquals($expectOne, count($allFulfillments));
		
		
		
		// AND we expect the correct item to be associated with the fulfillment
		$count = $this->Fulfillment->Order->OrderLineItem->find('count', array(
			'conditions' => array(
				'fulfillment_id'	=> $allFulfillments['0']['Fulfillment']['id']
			)
		));
		
		$expectOne = 1;
		$this->assertEquals($expectOne, $count);
	}

}
