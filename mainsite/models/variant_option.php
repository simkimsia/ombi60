<?php
class VariantOption extends AppModel {
	var $name = 'VariantOption';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Variant' => array(
			'className' => 'Variant',
			'foreignKey' => 'variant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProductOption' => array(
			'className' => 'ProductOption',
			'foreignKey' => 'product_option_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>