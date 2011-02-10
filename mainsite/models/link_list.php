<?php
class LinkList extends AppModel {
	var $name = 'LinkList';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'link_list_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Link.order ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function saveAll($data = null, $options = array()) {
		$data = $this->Link->beforeSaveAll($data);
		return parent::saveAll($data, $options);
	}

}
?>