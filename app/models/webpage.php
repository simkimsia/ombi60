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
		
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'parent_id',
			'dependent' => true,
			'conditions' => array('Link.parent_model' => 'Webpage'),
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
		$this->Link->recursive = -1;
		
		// get the new handle 
		$handle = $this->data['Webpage']['handle'];
		$model 	= '/pages/';
		// form the new route
		$route  = $model . $handle;
		// form the new fields and values
		$fields = array('Link.route' =>$route,
				'Link.model' =>$model,
				'Link.action'=>$action);
		
		// prepare the fields by wrapping the values in quotes
		App::import('Lib', 'StringManipulator');
		$fields = StringManipulator::iterateArrayWrapStringValuesInQuotes($fields);
		
		// meant only for all the Links belonging to this Webpage
		$conditions = array('Link.parent_id'=>$this->id,
				    'Link.parent_model'=>'Webpage');
		
		$this->Link->updateAll($fields, $conditions);
		
	}
	
	function beforeDelete() {
		// retrieve all the linklists that this webpage's link belongs to
		// meant only for all the Links belonging to this Webpage
		
		$conditions = array('Link.parent_id'=>$this->id,
				    'Link.parent_model'=>'Webpage');
		
		$this->Link->recursive = -1;
		$linklists = $this->Link->find('all', array('conditions'=>$conditions,
							    'fields'=>array('DISTINCT Link.link_list_id')));
		
		$this->linklists = Set::extract('{n}.Link', $linklists);
		
		return true;
	}
	
	function afterDelete() {
		
		foreach($this->linklists as $key=>$link_list) {
			$result = $this->Link->updateCounterCache($link_list);
		}
		$this->linklists = array();
	}
	
	
	
}
?>