<?php
/* Shipment Test cases generated on: 2010-09-16 03:09:07 : 1284601267*/
App::import('Model', 'Shipment');

class ShipmentTestCase extends CakeTestCase {
	var $fixtures = array('app.shipment', 'app.order', 'app.shop', 'app.theme', 'app.saved_theme', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.webpage', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.address', 'app.wishlist', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.payment', 'app.domain', 'app.shipped_to_country', 'app.country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate', 'app.order_line_item');

	function startTest() {
		$this->Shipment =& ClassRegistry::init('Shipment');
	}

	function endTest() {
		unset($this->Shipment);
		ClassRegistry::flush();
	}

}
?>