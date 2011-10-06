<?php
class SmartCollectionCondition extends AppModel {

	public $name = 'SmartCollectionCondition';
	public $validate = array(
		
		'field' => array('notempty'),
		'relation' => array('notempty'),
		'condition' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'ProductGroup' => array(
			'className' => 'ProductGroup',
			'foreignKey' => 'smart_collection_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>