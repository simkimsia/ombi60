<?php
/* CasualSurfer Test cases generated on: 2010-09-28 03:09:40 : 1285635640*/
App::import('Model', 'CasualSurfer');

class CasualSurferTestCase extends CakeTestCase {
	var $fixtures = array('app.casual_surfer', 'app.shop', 'app.theme', 'app.saved_theme', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.webpage', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order_line_item', 'app.order', 'app.address', 'app.payment', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.shipment', 'app.wishlist', 'app.domain', 'app.shipped_to_country', 'app.country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate');

	function startTest() {
		$this->CasualSurfer =& ClassRegistry::init('CasualSurfer');
	}

	function endTest() {
		unset($this->CasualSurfer);
		ClassRegistry::flush();
	}

}
?>