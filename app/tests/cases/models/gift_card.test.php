<?php
/* GiftCard Test cases generated on: 2010-09-04 14:09:51 : 1283604891*/
App::import('Model', 'GiftCard');

class GiftCardTestCase extends CakeTestCase {
	var $fixtures = array('app.gift_card', 'app.shop', 'app.theme', 'app.saved_theme', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.webpage', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order', 'app.address', 'app.order_line_item', 'app.payment', 'app.payment_module', 'app.shops_payment_module', 'app.wishlist', 'app.domain', 'app.gift_card_type', 'app.gc_design');

	function startTest() {
		$this->GiftCard =& ClassRegistry::init('GiftCard');
	}

	function endTest() {
		unset($this->GiftCard);
		ClassRegistry::flush();
	}

}
?>