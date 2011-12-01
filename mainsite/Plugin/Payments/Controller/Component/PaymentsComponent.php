<?php
App::uses('Component', 'Controller');
/**
 * 
 * This class implements Payments component to abstract payments module and calls specific 
 * gateway components methods
 * @author ajibarra
 *
 */
class PaymentsComponent extends Component {
	const PAYPAL_EXPRESS = 'Paypal Express Checkout';
	
	public $components = array('Payments.PaypalExpress');

	function initialize($controller) {
		$this->controller = $controller;
	}
	
/**
 * Setup the purchase on payment gateway
 * @param String $paymentGateway
 * @param mixed $purchaseInfo
 */
	public function setupPurchase($paymentGateway, $purchaseInfo = array()) {
		if ($paymentGateway == self::PAYPAL_EXPRESS) {
			$this->PaypalExpress->setupPurchase($purchaseInfo);
		}
	}
	
/**
 * Makes the purchase on payment gateway
 * @param String $paymentGateway
 * @param mixed $purchaseInfo
 */
	public function purchase($paymentGateway, $purchaseInfo = array()) {
		if ($paymentGateway == self::PAYPAL_EXPRESS) {
			return $this->PaypalExpress->purchase($purchaseInfo);
		}
	}
	
/**
 * Redirects to specific gateway URL
 * @param String $paymentGateway
 * @param mixed $redirectInfo
 */
	public function redirect($paymentGateway, $redirectInfo = array()) {
		if ($paymentGateway == self::PAYPAL_EXPRESS) {
			$this->controller->redirect($this->PaypalExpress->getUrlForToken($this->PaypalExpress->response->token()));
		} else {
			//Unknown payment method for this component
			return false;
		}
	}
	
/**
 * Gets properties from gateway response
 * @param String $paymentGateway
 * @param String $property
 */
	public function getFromResponse($paymentGateway, $property) {
		if ($paymentGateway == self::PAYPAL_EXPRESS) {
			return $this->PaypalExpress->response->__get($property);
		}
	}
	
/**
 * Returns true if Paypal Express gateway is used
 * @param String $paymentGateway
 */
	public function isPaypalExpress($paymentGateway) {
		return ($paymentGateway == self::PAYPAL_EXPRESS);
	}
}
?>