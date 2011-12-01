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
				$this->data['Link']['action1'] = $this->prependHttp($this->data['Link']['action1']);
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
	
	
	/**
	*
	* Given a url, we will prepend a http:// if it does NOT exist
	*
	* @param string $url Url to be prepended with http://
	* @return string
	*
	**/
	public function prependHttp($url) {
		$url = strtolower($url);
		if (strpos($url, 'http') === false) {
			return 'http://' . $url;
		}
		
		return $url;
	}
	
	/**
	 * Reorder the links in the list
	 *	Array (
	 *	[0] => 3, [1] => 1, [2] => 2
	 * )
	 * 
	 * @param array $data Data array where the keys are the order and the values are the link ids
	 * @param integer $listId LinkList id
	 * @return boolean Return true if successful, false otherwise.
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
	
	/**
	* before any saveAll for LinkList or Link, we want to prependHttp to all the web links
	* 
	* @param array $data Data array for the links and linklist
	* @return array Data array after being processed for prependHttp
	**/
	public function beforeSaveAll($data) {
		
		$links = array();
		
		// if we are doing a saveAssociated from LinkList
		if (isset($data['Link'])) {
			$links = $data['Link'];
		
		// if we are doing a saveMany from Link	
		} elseif (isset($data[0]['model'])) {
			$links = $data;
		}
		
		
		
		// iterate through the links and prepend the http
		foreach ($links as $key => $link) {

			if (isset($link['model']) &&
			    isset($link['action']) &&
			    isset($link['action1']) ) {
				
				if ($links[$key]['model'] === 'web') {
					$link['action1']             = $this->prependHttp($link['action1']);
					$link['action']              = $link['action1'];
					$links[$key]['route'] = $link['action1'];
				} else {
					$links[$key]['route'] = $link['model'] . $link['action'];
				}
				
			}

		}
		
		// if saveAssociated via LinkList
		if (isset($data['Link'])) {
			$data['Link'] = $links;
			
		// if saveMany via Link
		} elseif (isset($data[0]['model'])) {
			$data = $links;
		}
		
		return $data;
	}
	
	/**
	*
	* override the saveAll just in case it is used
	*
	* @param array $data 
	* @param array $options
	* @return boolean returns true if successful, false otherwise
	**/
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
	
}
?>