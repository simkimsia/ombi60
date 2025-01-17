<?php
/* PaydollarTransactions Test cases generated on: 2010-12-21 10:12:53 : 1292926913*/
App::import('Controller', 'PaydollarTransactions');

class TestPaydollarTransactionsController extends PaydollarTransactionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PaydollarTransactionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.paydollar_transaction', 'app.invoice', 'app.shop', 'app.saved_theme', 'app.theme', 'app.recurring_payment_profile', 'app.customer', 'app.user', 'app.group', 'app.language', 'app.casual_surfer', 'app.merchant', 'app.post', 'app.blog', 'app.comment', 'app.cart', 'app.cart_item', 'app.product', 'app.product_image', 'app.order_line_item', 'app.order', 'app.address', 'app.payment', 'app.shops_payment_module', 'app.payment_module', 'app.custom_payment_module', 'app.shipment', 'app.webpage', 'app.wishlist', 'app.domain', 'app.shipped_to_country', 'app.country', 'app.shipping_rate', 'app.price_based_rate', 'app.weight_based_rate');

	function startTest() {
		$this->PaydollarTransactions =& new TestPaydollarTransactionsController();
		$this->PaydollarTransactions->constructClasses();
	}

	function endTest() {
		unset($this->PaydollarTransactions);
		ClassRegistry::flush();
	}

}
?>