<?php
/* Vendor Test cases generated on: 2011-06-18 06:06:41 : 1308378581*/
App::import('Model', 'Vendor');

class VendorTestCase extends CakeTestCase {
	var $fixtures = array('app.vendor', 'app.shop', 'app.saved_theme', 'app.theme', 'app.shop_setting', 'app.recurring_payment_profile', 'app.invoice', 'app.subscription_plan', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.casual_surfer', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order_line_item', 'app.order', 'app.address', 'app.country', 'app.shipped_to_country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate', 'app.payment', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.paypal_payment_module', 'app.paypal_payers_payment', 'app.paypal_payer', 'app.shipment', 'app.products_in_group', 'app.product_group', 'app.smart_collection_condition', 'app.variant', 'app.webpage', 'app.wishlist', 'app.domain', 'app.link_list', 'app.link');

	function startTest() {
		$this->Vendor =& ClassRegistry::init('Vendor');
	}

	function endTest() {
		unset($this->Vendor);
		ClassRegistry::flush();
	}

}
?>