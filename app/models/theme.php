<?php
class Theme extends AppModel {
	var $name         = 'Theme';
	var $displayField = 'name';

	var $hasMany = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'theme_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		
		'SavedTheme' => array(
			'className' => 'SavedTheme',
			'foreignKey' => 'theme_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);




}
?>