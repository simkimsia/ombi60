<?php
class ShippedToCountry extends AppModel {
	public $name = 'ShippedToCountry';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
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
	
	public $hasMany = array(

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
	
	public $actsAs    = array(
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
	public function afterFind($results, $primary) {
		
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