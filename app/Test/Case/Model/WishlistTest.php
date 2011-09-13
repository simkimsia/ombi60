<?php
App::uses('Model', 'Wishlist');

class WishlistTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.wishlist', 'app.customer', 'app.shop', 'app.merchant', 'app.order', 'app.address', 'app.product', 'app.product_image', 'app.order_line_item', 'app.webpage', 'app.cart', 'app.cart_item', 'app.page_type', );

	public function setUp() {
		$this->Wishlist =& ClassRegistry::init('Wishlist');
	}

	public function tearDown() {
		unset($this->Wishlist);
		ClassRegistry::flush();
	}

}