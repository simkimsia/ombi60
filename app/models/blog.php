<?php
class Blog extends AppModel {
	var $name = 'Blog';
	var $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'blog_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	var $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	var $actsAs = array('Handleize.Sluggable'=> array(
				'fields' => 'title',
				'scope' => array('shop_id'),
				'conditions' => false,
				'slugfield' => 'short_name',
				'separator' => '-',
				'overwrite' => false,
				'length' => 150,
				'lower' => true
			),
			    'Handleize.Handleable'=>array(
				'handleFieldName' => 'short_name'
							  ));
	
	
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id,$table,$ds);
		$this->createVirtualFieldForUrl();
	}
	
	/**
	 * for use in templates for shopfront pages
	 * */
	function getTemplateVariable($blogs=array(), $multiple = true) {
		App::import('Lib', 'ArrayToIterator');
		$results = array();
		
		if (!$multiple) $blogs = array($blogs);
		
		foreach($blogs as $key=>$blog) {
			// prepare articles
			$articles = isset($blog['Post']) ? Post::getTemplateVariable($blog['Post']) : array();
			
			$blog = !empty($blog['Blog']) ? $blog['Blog'] : $blog;
			$result = array('id' => $blog['id'],
					   'title' => $blog['title'],
					   'handle' => $blog['short_name'],
					   'underscore_handle' => str_replace('-', '_', $blog['short_name']),
					   'url' => $blog['url'],
					   'all_articles_count' => $blog['visible_post_count'],
					   );
			
			$result['articles'] = $articles;
			if ($articles instanceof IteratorForTwig){
				$result['articles_count'] = $articles->getSize();
			} else{
				$result['articles_count'] = count($result['articles']);
			}
			
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