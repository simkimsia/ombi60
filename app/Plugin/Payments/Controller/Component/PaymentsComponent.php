<?php


class PaymentsComponent extends Component {
	const PAYPAL_EXPRESS = 'Paypal Express Checkout';
	
	public $components = array('Payments.PaypalExpress');

	function initialize($controller) {
		$this->controller = $controller;
	}
	
	public function setupPurchase($paymentGateway, $purchaseInfo = array()) {
		if ($paymentGateway == self::PAYPAL_EXPRESS) {
			return $this->PaypalExpress->setupPurchase($purchaseInfo);
		}
	}
	
	public function purchase($paymentGateway, $purchaseInfo = array()) {
		if ($paymentGateway == self::PAYPAL_EXPRESS) {
			return $this->PaypalExpress->purchase($purchaseInfo);
		}
	}
	
	public function redirect($paymentGateway, $redirectInfo = array()) {
		if ($paymentGateway == self::PAYPAL_EXPRESS) {
			$this->controller->redirect($this->PaypalExpress->getUrlForToken($this->PaypalExpress->response->token()));
		}
	}
	
	public function getFromResponse($paymentGateway, $property) {
		if ($paymentGateway == self::PAYPAL_EXPRESS) {
			return $this->PaypalExpress->response->__get($property);
		}
	}
	
	public function isPaypalExpress($paymentGateway) {
		return ($paymentGateway == self::PAYPAL_EXPRESS);
	}
}
?>