<?php
class Webpage extends AppModel {
	public $name         = 'Webpage';
	public $displayField = 'title';

	public $belongsTo = array(
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
	
	public $hasMany = array(
		
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
	
	public $actsAs = array('Handleize.Sluggable'=> array(
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
			    'Handleize.Handleable',
			    'ManyToManyCountable.ManyToManyCountable' => array(
				'LinkList'=>array(
					'className' 	=> 'LinkList',
					'joinModel' 	=> 'Link',
					'foreignKey'	=> 'parent_id',
					'associationForeignKey'	=> 'link_list_id',
					'unique'	=> true,
					'counterCache'  => 'link_count',
					'foreignScope' => array('Link.parent_model' => 'Webpage'),
					)
				),
			);
	
	public $linklists = array();
	
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id,$table,$ds);
		$this->createVirtualFieldForUrl();
	}
	
	/**
	 * for use in templates for shopfront pages
	 * */
	public static function getTemplateVariable($pages=array(), $multiple = true) {
		
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
			App::uses('ArrayToIterator', 'Lib');
			$results = ArrayToIterator::array2Iterator($results);
		}
		
		if (!$multiple && !empty($results)) {
			return current($results);
		} else if (!$multiple && empty($results)) {
			return array();
		}
		
		return $results;
	}
	
	/**
         * This function does a DEEP $this->find('first') 
         * supplying a Webpage that is with all the Webpage fields
         * with Author
         * 
         * @param mixed $idOrHandle Product Id or Handle
         * @param integer $visibleOrAll 3 possible CONSTANT values VISIBLE_ENTITY, HIDDEN_ENTITY, or HIDDEN_AND_VISIBLE_ENTITY  
         * @return array of webpage info as explained above
         * */
        public function getDetails($idOrHandle = '', $visibleOrAll = VISIBLE_ENTITY) {
		
		$shopId = Shop::get('Shop.id');
		
		$conditions = array('Webpage.shop_id' => $shopId);
		
		if ($visibleOrAll == VISIBLE_ENTITY) {
			$conditions['Webpage.visible'] = true;
		} elseif ($visibleOrAll == HIDDEN_ENTITY) {
			$conditions['Webpage.visible'] = false;
		}
		
		if (is_numeric($idOrHandle)) {
			$conditions['Webpage.id'] = $idOrHandle;
		} elseif (is_string($idOrHandle)) {
			$conditions['Webpage.handle'] = $idOrHandle;
		} else {
			return false;
		}
		
        $webpage = $this->find('first', array(
			'conditions'=>$conditions,
			'contain' => array(
				'Author' => array(
					'fields' => array(
						'Author.full_name',
						'Author.id',
						'Author.name_to_call')
					),
				),
			)
		);
		
		return $webpage;
	}

	public function handleMenuAction($data) {
		$resultArray = array('message'=>'No valid actions selected',
				     'success'=>false);
		
		switch($data['Webpage']['menu_action']) {
			case 'Delete' :
				$resultArray['success'] = $this->deleteSelected($data['Webpage']['selected']);
				$resultArray['message'] = ($resultArray['success']) ? 'Selected pages are successfully deleted' : 'Error';
				break;
				
			case 'Publish' :
				$resultArray['success'] = $this->publishSelected($data['Webpage']['selected']);
				$resultArray['message'] = ($resultArray['success']) ? 'Selected pages are successfully published' : 'Error';
				break;
				
			case 'Hide' :
				$resultArray['success'] = $this->hideSelected($data['Webpage']['selected']);
				$resultArray['message'] = ($resultArray['success']) ? 'Selected pages are successfully hidden' : 'Error';
				break;
			
		}
		
		return $resultArray;
	}
	
	public function deleteSelected($selected = array()) {
		$selected = array_unique($selected);
		return $this->deleteAll(array('Webpage.id'=>$selected,
					      'Webpage.shop_id'=>Shop::get('Shop.id')));
	}
	
	public function publishSelected($selected = array()) {
		$this->recursive = -1;
		$selected = array_unique($selected);
		return $this->updateAll(array('Webpage.visible'=>true),
					array('Webpage.id' => $selected,
					      'Webpage.shop_id'=>Shop::get('Shop.id')));
	}
	
	public function hideSelected($selected = array()) {
		$this->recursive = -1;
		$selected = array_unique($selected);
		return $this->updateAll(array('Webpage.visible'=>0),
					array('Webpage.id' => $selected,
					      'Webpage.shop_id'=>Shop::get('Shop.id')));
	}
	
	public function afterSave($created) {
		$this->Link->recursive = -1;
		
		// get the new handle 
		$handle = $this->data['Webpage']['handle'];
		$model 	= '/pages/';
		// form the new route
		$route  = $model . $handle;
		// form the new fields and values
		$fields = array('Link.route' =>$route,
				'Link.model' =>$model,
				'Link.action'=>$handle);
		
		// prepare the fields by wrapping the values in quotes
		App::uses('StringLib', 'UtilityLib.Lib');
		$fields = StringLib::iterateArrayWrapStringValuesInQuotes($fields);
		
		// meant only for all the Links belonging to this Webpage
		$conditions = array('Link.parent_id'=>$this->id,
				    'Link.parent_model'=>'Webpage');
		
		$this->Link->updateAll($fields, $conditions);
		
	}

}