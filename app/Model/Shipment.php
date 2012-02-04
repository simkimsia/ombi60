<?php
class Shipment extends AppModel {
	public $name = 'Shipment';
	public $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function getOptionsForCheckout($shippedAmt, $shippedWeight, $shop_id, $country) {
		$shippingRate 	         = $this->Order->Shop->ShippedToCountry->ShippingRate;
		$shippingRate->recursive = -1;
		$shippingRate->Behaviors->load('Linkable.Linkable');
		
		$shippingRate->PriceBasedRate->Behaviors->load('Linkable.Linkable');
		$shippingRate->WeightBasedRate->Behaviors->load('Linkable.Linkable');
		
		// get the suitable ShippedToCountry based on shop_id and country_id
		$this->Order->Shop->ShippedToCountry->recursive = -1;
		$shippedToCountries = $this->Order->Shop->ShippedToCountry->find('all', array('conditions'=>array('ShippedToCountry.shop_id'=>$shop_id)));
		
		$countries = Set::extract('/ShippedToCountry[country_id='.$country.']/id', $shippedToCountries);
		
		// initialize as zero which means no such thing
		$shippedToCountryId = 0;
		
		// now we look for rest of the world shipping setting
		if (empty($countries)) {
			$countries = Set::extract('/ShippedToCountry[country_id=0]/id', $shippedToCountries);
		}
		
		// either YEA!! they do ship to this country specifically or they do ship to this country via country 0
		$shippedToCountryId = $countries[0];
		
		$conditionsForPrice = array('AND' => array(array('ShippedToCountry.id'=>$shippedToCountryId),
							   array('PriceBasedRate.min_price <=' =>$shippedAmt),
							   array('OR' => array(
										array('ShippedToCountry.country_id' =>0),
										array('ShippedToCountry.country_id' =>$country)
									)
								),
							   array('OR' => array(
										array('PriceBasedRate.max_price >=' =>$shippedAmt),
										array('PriceBasedRate.max_price ' => null)
									)
								)
							)
					);
		
		$conditionsForWeight = array('AND' => array(array('ShippedToCountry.id'=>$shippedToCountryId),
							   array('WeightBasedRate.min_weight <=' =>$shippedWeight),
							   array('OR' => array(
										array('ShippedToCountry.country_id' =>0),
										array('ShippedToCountry.country_id' =>$country)
									)
								),
							   array('OR' => array(
										array('WeightBasedRate.max_weight >=' =>$shippedWeight),
										array('WeightBasedRate.max_weight ' => null)
									)
								)
							)
					);
		
		// this is so that the virtual field works 
		$shippingRate->PriceBasedRate->virtualFields['display_name'] = $shippingRate->virtualFields['display_name'];
		
		$priceBasedRates = $shippingRate->PriceBasedRate->find('all', array('conditions'=>$conditionsForPrice,
								   'fields'=>array('ShippingRate.id', 'display_name', 'ShippingRate.price', 'PriceBasedRate.min_price', 'PriceBasedRate.max_price'),
								   'link'=>array('ShippingRate'=>array('ShippedToCountry'))));
		
		$shippingRate->WeightBasedRate->virtualFields['display_name'] = $shippingRate->virtualFields['display_name'];
		
		$weightBasedRates = $shippingRate->WeightBasedRate->find('all', array('conditions'=>$conditionsForWeight,
								   'fields'=>array('ShippingRate.id', 'display_name', 'ShippingRate.price', 'WeightBasedRate.min_weight', 'WeightBasedRate.max_weight'),
								   'link'=>array('ShippingRate'=>array('ShippedToCountry'))));
		
		
		$shippingRatesByName = Set::combine($priceBasedRates, '{n}.ShippingRate.id', '{n}.PriceBasedRate.display_name');
		$shippingRatesByPrice = Set::combine($priceBasedRates, '{n}.ShippingRate.id', '{n}.ShippingRate.price');
		
		$weightShippingRatesByName = Set::combine($weightBasedRates, '{n}.ShippingRate.id', '{n}.WeightBasedRate.display_name');
		$weightShippingRatesByPrice = Set::combine($weightBasedRates, '{n}.ShippingRate.id', '{n}.ShippingRate.price');
		/*
		return array(
			'display'=> $shippingRatesByName + $weightShippingRatesByName,
			'price' => $shippingRatesByPrice + $weightShippingRatesByPrice
		);
		*/
		
		return $shippingRatesByName + $weightShippingRatesByName;

	}
	
	/**
	*
	* Gets Price from the display_name of the shipment option
	* The shipment option display name is in the format Standard Shipping - $10.00
	*
	* @param string $displayNameOfShipmentOption
	* @return float Returns float 
	**/
	public function getPriceFromDisplayName($displayNameOfShipmentOption) {
		$tok = strtok($displayNameOfShipmentOption, " -$");
		while ($tok !== false) {
			$lastKnown = $tok;
		    $tok = strtok(" -$");
		}
		return $lastKnown;
	}
	
	/**
	*
	* Get Fulfillment Name from Status value
	*
	* @param int $status
	* @return string Returns name as indicated in bootstrap
	**/
	public function getStatusNameGiven($status) {
		switch($status) {
			
			define('FULFILLMENT_NOT_FULFILLED', 1);
			define('FULFILLMENT_PARTIAL', 2);
			define('FULFILLMENT_FULFILLED', 0);
			
			case FULFILLMENT_NOT_FULFILLED:
				return 'No';
				break;
			case FULFILLMENT_FULFILLED:
				return 'Yes';
				break;
			case FULFILLMENT_PARTIAL:
				return 'Partial';
				break;				
		}
		return '';
		
	}
}
?>