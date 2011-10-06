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
}
?>