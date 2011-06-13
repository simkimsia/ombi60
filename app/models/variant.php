<?php
class Variant extends AppModel {
	var $name = 'Variant';
	var $displayField = 'title';
	
	
	var $actsAs = array('UnitSystemConvertible',);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed



	var $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	/**
	 * For unit conversion
	 * */
	function beforeSave() {
		
                $unit = Shop::get('ShopSetting.unit_system');
		
		foreach ($this->data as $key => $val) {
			if (isset($val['Variant'])) {
				$this->data[$key] = $this->convertForSave($val, $unit);
			}
			if ($key == 'Variant') {
				$resultingProductArray = $this->convertForSave(array($key => $this->data[$key]), $unit);
				$this->data[$key] = $resultingProductArray[$key];
			}
		}
		
		
		return true;
	}
}
?>