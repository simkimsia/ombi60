<?php
class LinkList extends AppModel {
	public $name = 'LinkList';
	public $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
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
	
	public $actsAs = array('Handleize.Sluggable'=> array(
				'fields' => 'name',
				'scope' => array('shop_id'),
				'conditions' => false,
				'slugfield' => 'handle',
				'separator' => '-',
				'overwrite' => false,
				'length' => 150,
				'lower' => true
			),
			    'Handleize.Handleable');
	
	public function saveAll($data = null, $options = array()) {
		$data = $this->Link->beforeSaveAll($data);
		return parent::saveAll($data, $options);
	}
	
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id,$table,$ds);
		$this->createVirtualFieldForUrl();
	}
	
	/**
	 * for use in templates for shopfront pages
	 * */
	public static function getTemplateVariable($linklists=array(), $multiple = true) {
		App::uses('ArrayToIterator', 'Lib');
		$results = array();
		
		if (!$multiple) $linklists = array($linklists);
		
		foreach($linklists as $key=>$linklist) {
			
			$result = array('id' => $linklist['LinkList']['id'],
					'title' => $linklist['LinkList']['name'],
					'handle' => $linklist['LinkList']['handle'],
					'underscore_handle' => str_replace('-', '_', $linklist['LinkList']['handle']),
					'url' => $linklist['LinkList']['url'],
					);
			
			$result['links'] = isset($linklist['Link']) ? Link::getTemplateVariable($linklist['Link']) : array();
			
			$results[$result['underscore_handle']] = $result;
		}
		
		if ($multiple && TWIG_ITERATOR) {
			$results = ArrayToIterator::array2Iterator($results);
		}
		
		if (!$multiple && !empty($results)) {
			return current($results);
		} else if (!$multiple && empty($results)) {
			return array();
		}
		
		return $results;
	}

}
?>