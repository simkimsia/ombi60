<?php
class PaydollarTransaction extends AppModel {
	public $name = 'PaydollarTransaction';
	public $displayField = 'payref';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'ref',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>