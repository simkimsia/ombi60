<?php
class VariantOption extends AppModel {
	public $name = 'VariantOption';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Variant' => array(
			'className' => 'VariantModel',
			'foreignKey' => 'variant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
	);
}
?>