<?php
/* LinkLists Test cases generated on: 2011-07-18 20:07:45 : 1311022665*/
App::import('Controller', 'LinkLists');

class TestLinkListsController extends LinkListsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class LinkListsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.link_list', 'app.shop', 'app.saved_theme', 'app.theme', 'app.shop_setting', 'app.recurring_payment_profile', 'app.invoice', 'app.subscription_plan', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.casual_surfer', 'app.merchant', 'app.post', 'app.blog', 'app.link', 'app.product', 'app.vendor', 'app.product_type', 'app.product_image', 'app.products_in_group', 'app.product_group', 'app.smart_collection_condition', 'app.variant', 'app.cart_item', 'app.cart', 'app.order', 'app.address', 'app.country', 'app.shipped_to_country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate', 'app.order_line_item', 'app.payment', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.paypal_payment_module', 'app.paypal_payers_payment', 'app.paypal_payer', 'app.shipment', 'app.variant_option', 'app.product_option', 'app.webpage', 'app.comment', 'app.wishlist', 'app.domain');

	function startTest() {
		$this->LinkLists =& new TestLinkListsController();
		$this->LinkLists->constructClasses();
	}

	function endTest() {
		unset($this->LinkLists);
		ClassRegistry::flush();
	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>