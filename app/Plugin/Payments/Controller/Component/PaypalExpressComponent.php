<?php

/**
 * 
 * This class implements Paypal Express Component and executes gateway methods
 * @author ajibarra
 *
 */
class PaypalExpressComponent extends Component {

	public $response;
	
	public $datasource;

	function __construct($collection, $settings) {
		parent::__construct($collection, $settings);
		$this->datasource = ConnectionManager::getDataSource('paypal_express');
	}

/**
 * Setup purchase on gateway
 * @param String $gateway_type
 * @param Double $amount
 */
	function setupPurchase($purchaseInfo) {
		$gateway = $this->datasource->getGateway();
		$options = array_merge($purchaseInfo, array(
			'return_url' => $this->datasource->getReturnUrl(),
			'cancel_return_url' => $this->datasource->getCancelUrl(),
		));
		$this->response = $gateway->setup_purchase($purchaseInfo['amount'], $options);
	}
	
	/**
	 * Get URL for given token
	 * @param String $token
	 * @return String
	 */
	function getUrlForToken($token) {
		$gateway = $this->datasource->getGateway();
		return $gateway->url_for_token($token);
	}


/**
 * Execute purchase
 * @param String $purchase_info
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