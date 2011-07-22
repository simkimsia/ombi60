<?php
class ShippedToCountry extends AppModel {
	var $name = 'ShippedToCountry';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(

		'ShippingRate' => array(
			'className' => 'ShippingRate',
			'foreignKey' => 'shipped_to_country_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	
	var $actsAs    = array(
			       'UnitSystemConvertible' => array(
					'weight_fields' =>array(
						'min_weight',
						'max_weight',
							),
					'model_name' => 'WeightBasedRate',
					
								),
			       );
	
	/**
	 * For unit conversion
	 * */
	function afterFind($results, $primary) {
		
                $unit = Shop::get('ShopSetting.unit_system');
		
		foreach ($results as $key => $val) {
			if (isset($val['WeightBasedRate'])) {
				$results[$key] = $this->convertForDisplay($val, $unit);
			}
		}
		
		
		return $results;
	}

}
?>