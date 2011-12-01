<?php
/* ShopSetting Test cases generated on: 2011-03-28 05:03:54 : 1301291454*/
App::import('Model', 'ShopSetting');

class ShopSettingTestCase extends CakeTestCase {
	var $fixtures = array('app.shop_setting', 'app.shop', 'app.saved_theme', 'app.theme', 'app.recurring_payment_profile', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.casual_surfer', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.cart', 'app.cart_item', 'app.product', 'app.vendor', 'app.product_image', 'app.order_line_item', 'app.order', 'app.address', 'app.country', 'app.shipped_to_country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate', 'app.payment', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.paypal_payment_module', 'app.paypal_payers_payment', 'app.paypal_payer', 'app.shipment', 'app.products_in_group', 'app.product_group', 'app.webpage', 'app.wishlist', 'app.domain');

	function startTest() {
		$this->ShopSetting =& ClassRegistry::init('ShopSetting');
	}

	function endTest() {
		unset($this->ShopSetting);
		ClassRegistry::flush();
	}

}
?>