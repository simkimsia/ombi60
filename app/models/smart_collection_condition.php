<?php
class SmartCollectionCondition extends AppModel {

	var $name = 'SmartCollectionCondition';
	var $validate = array(
		'smart_collection_id' => array('numeric'),
		'field' => array('notempty'),
		'relation' => array('notempty'),
		'condition' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'SmartCollection' => array(
			'className' => 'ProductGroup',
			'foreignKey' => 'smart_collection_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>