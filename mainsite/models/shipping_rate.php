<?php
class ShippingRate extends AppModel {
	var $name = 'ShippingRate';
	var $displayField = 'name';
	
	
	var $actsAs    = array(
			       'UnitSystemConvertible' => array(
					'weight_fields' =>array(
						'min_weight',
						'max_weight',
							),
					'model_name' => 'WeightBasedRate',
					
								),
			       );
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasOne = array(
		'PriceBasedRate' => array(
			'className' => 'PriceBasedRate',
			'foreignKey' => 'shipping_rate_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'WeightBasedRate' => array(
			'className' => 'WeightBasedRate',
			'foreignKey' => 'shipping_rate_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $belongsTo = array(
		'ShippedToCountry' => array(
			'className' => 'ShippedToCountry',
			'foreignKey' => 'shipped_to_country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	var $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Name is required.'
			),
		),
		'price' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Shipping price requires a number'
			),
			'positive' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => 'Shipping price should be at least $0.00'
			),
			'max999' => array(
				'rule' => array('comparison', '<=', 999.99),
				'message' => 'Shipping price should be at most $999.99'
			),
		),
	);
	
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id,$table,$ds);
		$this->virtualFields = array(
			'display_name'=>"CONCAT(`{$this->alias}`.`name`,' - $', FORMAT(`{$this->alias}`.`price`, 2))"
		);
	}
	
	
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