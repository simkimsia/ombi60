<?php
class SmartCollectionCondition extends AppModel {

	var $name = 'SmartCollectionCondition';
	var $validate = array(
		
		'field' => array('notempty'),
		'relation' => array('notempty'),
		'condition' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
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