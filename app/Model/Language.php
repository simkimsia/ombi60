<?php
class Language extends AppModel {
	public $name = 'Language';
	public $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'language_id',
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