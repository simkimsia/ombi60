<?php


class PaypalExpressComponent extends Component {

	public $returnUrl;

	public $cancelUrl;
	
	public $response;
	
	public $datasource;

	function __construct($collection, $settings) {
		parent::__construct($collection, $settings);
		$this->datasource = ConnectionManager::getDataSource('paypal_express');
	}

/**
 * Setup purchase on gateway
 * @param unknown_type $gateway_type
 * @param unknown_type $amount
 */
	function setupPurchase($purchaseInfo) {
		$gateway = $this->datasource->getGateway();
		$options = array_merge($purchaseInfo, array(
			'return_url' => $this->datasource->getReturnUrl(),
			'cancel_return_url' => $this->datasource->getCancelUrl(),
		));
		$this->response = $gateway->setup_purchase($purchaseInfo['amount'], $options);
	}
	
	function getUrlForToken($token) {
		$gateway = $this->datasource->getGateway();
		return $gateway->url_for_token($token);
	}


/**
 * Execute purchase
 * @param unknown_type $purchase_info
 * @return boolean
 */
	function purchase($purchaseInfo) {
		$gateway = $this->datasource->getGateway();
		$response = $gateway->get_details_for( $purchaseInfo['token'], $purchaseInfo['PayerID']);	
		$response = $gateway->purchase($response->amount());
		return $response;
	}

}
?>