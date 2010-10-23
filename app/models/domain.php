<?php
class Domain extends AppModel {
	
	var $name = 'Domain';

	var $displayField = 'domain';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

	);
}
?>