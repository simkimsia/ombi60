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
		if (isset($this->data['Link']['model']) && isset($this->data['Link']['action'])) {
			$this->data['Link']['route'] = $this->data['Link']['model'] . $this->data['Link']['action'];	
		}
		
		
		// only for create
		if (!isset($this->data['Link']['id'])) {
			$this->recursive = -1;
			$this->data['Link']['order'] = $this->find('count', array('conditions'=>array('Link.link_list_id'=>$this->data['Link']['link_list_id'])));
			$this->recursive = 0;	
		}
		
	}
	
	
	
	/**
	 * reorder the links in the list
	 *
	 *2011-01-10 11:07:36 Error: Array
		
		[0] => 3
		[1] => 1
		[2] => 2
		
		
	)
	 * 
	 * */
	function saveOrder($data=array(), $listId) {
		
		if (!is_array($data) || empty($data) || !is_numeric($listId) || $listId <= 0) {
			return false;
		}
		
		// first we check if all the ids belong to same list
		// and if the list are exhaustive. we cannot have incomplete list
		$this->recursive = -1;
		$links = $this->find('all', array('conditions'=>array('Link.link_list_id'=>$listId),
						  'fields'    =>array('Link.id')));
		
		$linkIdsInArray = Set::extract('{n}.Link.id', $links);
		
		if (count($linkIdsInArray) !== count($data)) {
			return false;
		}
		
		$firstDiff  = array_diff($data, $linkIdsInArray);
		$secondDiff = array_diff($linkIdsInArray, $data);
		
		if (!empty($firstDiff) || !empty($secondDiff)) {
			return false;
		}
		
		// at this point, we are absolutely sure that the $data is comprehensive.
		// we can do the saveAll now.
		$newlyInsertedData = array('Link'=>array());
		foreach($data as $order=>$id) {
			$newlyInsertedData['Link'][] = array('id'=>$id,
							     'order'=>$order);
		}
	
		// because we update existing entries
		// so we need to directly use 1 level below Link
		return $this->saveAll($newlyInsertedData['Link'], array('validate'=>false));
		
	}
}
?>