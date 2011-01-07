<?php
class Link extends AppModel {
	var $name = 'Link';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'LinkList' => array(
			'className' => 'LinkList',
			'foreignKey' => 'link_list_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function beforeValidate() {
		$this->data['Link']['route'] = $this->data['Link']['model'] . $this->data['Link']['action'];
	}
}
?>