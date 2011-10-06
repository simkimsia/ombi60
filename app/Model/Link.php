<?php
class Link extends AppModel {
	public $name = 'Link';
	public $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'LinkList' => array(
			'className' => 'LinkList',
			'foreignKey' => 'link_list_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => true,
		),
		'Blog' => array(
			'className' => 'Blog',
			'foreignKey' => 'parent_id',
			'conditions' => array('Link.parent_model'=>'Blog'),
			'fields' => '',
			'order' => '',
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'parent_id',
			'conditions' => array('Link.parent_model'=>'Product'),
			'fields' => '',
			'order' => '',
		),
		'Webpage' => array(
			'className' => 'Webpage',
			'foreignKey' => 'parent_id',
			'conditions' => array('Link.parent_model'=>'Webpage'),
			'fields' => '',
			'order' => '',
		),
	);
	
	public function beforeValidate() {
		
		if (isset($this->data['Link']['model']) &&
		    isset($this->data['Link']['action']) &&
		    isset($this->data['Link']['action1'])) {
			
			if ($this->data['Link']['model'] === 'web') {
				$this->data['Link']['action1'] = $this->convertLink($this->data['Link']['action1']);
				$this->data['Link']['action']  = $this->data['Link']['action1'];
				$this->data['Link']['route'] = $this->data['Link']['action1'];	
				
			} else {
				$this->data['Link']['route'] = $this->data['Link']['model'] . $this->data['Link']['action'];		
			}
			
		}
		
		
		// only for create
		if (!isset($this->data[$this->alias]['id'])) {
			$this->recursive = -1;
			$this->data[$this->alias]['order'] = $this->find('count', array('conditions'=>array($this->alias.'.link_list_id'=>$this->data[$this->alias]['link_list_id'])));
			$this->recursive = 0;	
		}
		
	}
	
	public function convertLink($url) {
		$url = strtolower($url);
		if (strpos($url, 'http') === false) {
			return 'http://' . $url;
		}
		
		return $url;
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
	public function saveOrder($data=array(), $listId) {
		
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
	
	// before any saveAll for LinkList or Link
	// we want to 
	public function beforeSaveAll($data) {
		
		if (isset($data['Link'])) {
			foreach($data['Link'] as $key=>$link) {
				if (isset($link['model']) &&
				    isset($link['action']) &&
				    isset($link['action1']) ) {
					
					if ($data['Link'][$key]['model'] === 'web') {
						$link['action1']             = $this->convertLink($link['action1']);
						$link['action']              = $link['action1'];
						$data['Link'][$key]['route'] = $link['action1'];
					} else {
						$data['Link'][$key]['route'] = $link['model'] . $link['action'];
					}
					
				}
			}
		}
		
		return $data;
		
	}
	
	public function saveAll($data = null, $options = array()) {
		$data = $this->beforeSaveAll($data);
		return parent::saveAll($data, $options);
	}
	
	/**
	 * for use in templates for shopfront pages
	 **/
	public static function getTemplateVariable($links=array(), $multiple = true) {
		
		$results = array();
		
		if (!$multiple) $links = array($links);
		
		foreach($links as $key=>$link) {
			$link = isset($link['Link']) ? $link['Link'] : $link;
			$result = array('id' => $link['id'],
					'title' => $link['name'],
					'url' => $link['route'],
					);
			
			
			$results[] = $result;
		}
		
		if ($multiple && TWIG_ITERATOR) {
			App::uses('ArrayToIterator', 'Lib');
			$results = ArrayToIterator::array2Iterator($results);
		}
		
		if (!$multiple && !empty($results[0])) {
			return $results[0];
		} else if (!$multiple && empty($results[0])) {
			return array();
		}
		
		return $results;
	}
	
	/**
	 * override the original updateAll
	 * if it comes from Webpage, Product, Blog,
	 * then the $parentModel is set as 'Webpage', etc
	 * 
	
	public function deleteAll($fields, $conditions = true, $parentModel = false) {
		$parentModels = array('Blog', 'Webpage', 'Product');
		
		$updateCounterCacheInLinkLists = in_array($parentModel, $parentModels);
				
		if ($updateCounterCacheInLinkLists) {
			// get all the parent linklists id
		}
		parent::updateAll($fields, $conditions);
		if ($updateCounterCacheInLinkLists) {
			// now update all the parent linklists id
		}
	}
	 **/
}
?>