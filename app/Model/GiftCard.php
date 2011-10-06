<?php
class GiftCard extends AppModel {
	public $name = 'GiftCard';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'GiftCardType' => array(
			'className' => 'GiftCardType',
			'foreignKey' => 'gift_card_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'GcDesign' => array(
			'className' => 'GcDesign',
			'foreignKey' => 'gc_design_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>