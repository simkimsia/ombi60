<?php
/* RecurringPaymentProfile Test cases generated on: 2010-12-13 08:12:57 : 1292230437*/
App::import('Model', 'RecurringPaymentProfile');

class RecurringPaymentProfileTestCase extends CakeTestCase {
	var $fixtures = array('app.recurring_payment_profile', 'app.shop', 'app.saved_theme', 'app.theme', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.casual_surfer', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order_line_item', 'app.order', 'app.address', 'app.payment', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.shipment', 'app.webpage', 'app.wishlist', 'app.domain', 'app.shipped_to_country', 'app.country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate');

	function startTest() {
		$this->RecurringPaymentProfile =& ClassRegistry::init('RecurringPaymentProfile');
	}

	function endTest() {
		unset($this->RecurringPaymentProfile);
		ClassRegistry::flush();
	}

}
?>