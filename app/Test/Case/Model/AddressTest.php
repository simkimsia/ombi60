<?php
/* Address Test cases generated on: 2011-09-22 09:42:11 : 1316684531*/
App::uses('Address', 'Model');

/**
 * Address Test Case
 *
 */
class AddressTestCase extends CakeTestCase {
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

		$this->Address = ClassRegistry::init('Address');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Address);
		ClassRegistry::flush();

		parent::tearDown();
	}

/**
 * testGetAllByCustomerId method
 *
 * @return void
 */
	public function testGetAllByCustomerShouldRetrieveDeliveryAddress() {
		
		// GIVEN we have  Address 2 for Customer 1 as DELIVERY in fixtures
		
		// WHEN we run getALLByCustomer(2, DELIVERY)
		$result = $this->Address->getAllByCustomer(1, DELIVERY);
		
		// THEN we should get back the Address 2
		$addressFixture = new AddressFixture();
		$deliveryAddress = $addressFixture->records[1];
		
		$expected = array(
			'0' => array(
				'Address' => $deliveryAddress,
				'Country' => array(
					'id' => '192',
					'iso' => 'SG',
					'name' => 'SINGAPORE',
					'printable_name' => 'Singapore',
					'iso3' => 'SGP',
					'numcode' => '702'
				),
			)
		);
		
		$this->assertEquals($expected, $result);
	}

}
