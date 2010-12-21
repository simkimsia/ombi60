<?php
class PaydollarTransaction extends AppModel {
	var $name = 'PaydollarTransaction';
	var $displayField = 'payref';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
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