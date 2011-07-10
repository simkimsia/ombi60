<?php
class Webpage extends AppModel {
	var $name         = 'Webpage';
	var $displayField = 'title';

	var $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'RealAuthor' => array(
			'className' => 'User',
			'foreignKey' => 'real_author',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Author'=>array(
			'className' => 'User',
			'foreignKey' => 'author',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	var $hasMany = array(
		
		'PageLink' => array(
			'className' => 'Link',
			'foreignKey' => 'parent_id',
			'dependent' => true,
			'conditions' => array('PageLink.parent_model' => 'Webpage'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => false,
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	
	var $actsAs = array('Handleize.Sluggable'=> array(
				'fields' => 'title',
				'scope' => array('shop_id'),
				'conditions' => false,
				'slugfield' => 'handle',
				'separator' => '-',
				'overwrite' => false,
				'length' => 150,
				'lower' => true
			),
			    'Visible.Visible',
			    'Handleize.Handleable');
	
	var $linklists = array();
	
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id,$table,$ds);
		$this->createVirtualFieldForUrl();
	}
	
	/**
	 * for use in templates for shopfront pages
	 * */
	function getTemplateVariable($pages=array(), $multiple = true) {
		
		$results = array();
		
		if (!$multiple) $pages = array($pages);
		
		foreach($pages as $key=>$page) {
			
			$result = array('id' => $page['Webpage']['id'],
					'title' => $page['Webpage']['title'],
					'content' => $page['Webpage']['content'],
					'handle' => $page['Webpage']['handle'],
					'underscore_handle' => str_replace('-', '_', $page['Webpage']['handle']),
					'url' => $page['Webpage']['url'],
					);
			
			$result['author'] = isset($page['Author']['name_to_call']) ? $page['Author']['name_to_call'] : '';
			
			$results[$result['underscore_handle']] = $result;
		}
		
		if ($multiple && TWIG_ITERATOR) {
			App::import('Lib', 'ArrayToIterator');
			$results = ArrayToIterator::array2Iterator($results);
		}
		
		if (!$multiple && !empty($results)) {
			return current($results);
		} else if (!$multiple && empty($results)) {
			return array();
		}
		
		return $results;
	}
	
	function afterSave($created) {
		$this->PageLink->recursive = -1;
		
		// get the new handle 
		$handle = $this->data['Webpage']['handle'];
		$model 	= '/pages/';
		// form the new route
		$route  = $model . $handle;
		// form the new fields and values
		$fields = array('PageLink.route' =>$route,
				'PageLink.model' =>$model,
				'PageLink.action'=>$action);
		
		// prepare the fields by wrapping the values in quotes
		App::import('Lib', 'StringManipulator');
		$fields = StringManipulator::iterateArrayWrapStringValuesInQuotes($fields);
		
		// meant only for all the PageLinks belonging to this Webpage
		$conditions = array('PageLink.parent_id'=>$this->id,
				    'PageLink.parent_model'=>'Webpage');
		
		$this->PageLink->updateAll($fields, $conditions);
		
	}
	function beforeDelete() {
		// retrieve all the linklists that this webpage's link belongs to
		// meant only for all the PageLinks belonging to this Webpage
		
		$conditions = array('PageLink.parent_id'=>$this->id,
				    'PageLink.parent_model'=>'Webpage');
		
		$this->PageLink->recursive = -1;
		$linklists = $this->PageLink->find('all', array('conditions'=>$conditions,
								'fields'=>array('DISTINCT PageLink.link_list_id')));
		$this->log($linklists);
		$this->linklists = Set::extract('{n}.PageLink', $linklists);
		$this->log($this->linklists);
		return true;
	}
	
	function afterDelete() {
		$this->log('after');
		foreach($this->linklists as $key=>$link_list) {
			$this->log($link_list);
			$result = $this->Shop->LinkList->Link->updateCounterCache($link_list);
			$this->log($result);
		}
		$this->linklists = array();
	}
	
	
	
}
?>