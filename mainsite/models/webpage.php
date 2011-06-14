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
		
		if (!$multiple && !empty($results)) {
			return current($results);
		} else if (!$multiple && empty($results)) {
			return array();
		}
		
		return $results;
	}
	
}
?>