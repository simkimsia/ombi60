<?php
class GiftCardType extends AppModel {
	var $name = 'GiftCardType';
	var $displayField = 'type';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'GiftCard' => array(
			'className' => 'GiftCard',
			'foreignKey' => 'gift_card_type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>