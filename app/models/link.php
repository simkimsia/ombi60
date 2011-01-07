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
			'order' => '',
			'counterCache' => true,
		)
	);
	
	function beforeValidate() {
		$this->data['Link']['route'] = $this->data['Link']['model'] . $this->data['Link']['action'];
		
		// only for create
		if (!isset($this->data['Link']['id'])) {
			$this->recursive = -1;
			$this->data['Link']['order'] = $this->find('count', array('conditions'=>array('Link.link_list_id'=>$this->data['Link']['link_list_id'])));
			$this->recursive = 0;	
		}
		
	}
}
?>