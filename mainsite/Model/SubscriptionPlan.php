<?php
class SubscriptionPlan extends AppModel {
	public $name = 'SubscriptionPlan';
	public $displayField = 'id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $hasMany = array(
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'title',
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