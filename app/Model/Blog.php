<?php
class Blog extends AppModel {
	public $name = 'Blog';
	public $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $hasMany = array(
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
		),
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'parent_id',
			'dependent' => true,
			'conditions' => array('Link.parent_model' => 'Blog'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	
		
	);
	
	public $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	public $actsAs = array('Handleize.Sluggable'=> array(
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
							  ),
			    'ManyToManyCountable.ManyToManyCountable' => array(
				'LinkList'=>array(
					'className' 	=> 'LinkList',
					'joinModel' 	=> 'Link',
					'foreignKey'	=> 'parent_id',
					'associationForeignKey'	=> 'link_list_id',
					'unique'	=> true,
					'counterCache'  => 'link_count',
					'foreignScope' => array('Link.parent_model' => 'Blog'),
					))
			    );
	
	
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id,$table,$ds);
		$this->createVirtualFieldForUrl();
	}
	
	/**
	 * for use in templates for shopfront pages
	 * */
	public static function getTemplateVariable($blogs=array(), $multiple = true) {
		App::uses('ArrayToIterator', 'Lib');
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
	
	public function afterSave($created) {
		$this->updateBlogLinks();
		$this->updateHandlesInArticles();
	}
	
	private function updateHandlesInArticles() {
		$this->Post->recursive = -1;
		// get the new handle 
		$handle = $this->data['Blog']['short_name'];
		
		// form the new fields and values
		$fields = array('Post.blog_handle' =>$handle);
		
		// prepare the fields by wrapping the values in quotes
		App::uses('StringManipulator', 'Lib');
		$fields = StringManipulator::iterateArrayWrapStringValuesInQuotes($fields);
		
		// meant only for all the BlogLinks belonging to this Blog
		$conditions = array('Post.blog_id'=>$this->id);
		
		return $this->Post->updateAll($fields, $conditions);
		
	}
	
	private function updateBlogLinks() {
		$this->Link->recursive = -1;
		
		// get the new handle 
		$handle = $this->data['Blog']['short_name'];
		$model 	= '/blogs/';
		$action = $handle;
		
		// form the new route
		$route  = $model . $handle;
		// form the new fields and values
		$fields = array('Link.route' =>$route,
				'Link.model' =>$model,
				'Link.action'=>$action);
		
		// prepare the fields by wrapping the values in quotes
		App::uses('StringManipulator', 'Lib');
		$fields = StringManipulator::iterateArrayWrapStringValuesInQuotes($fields);
		
		// meant only for all the Links belonging to this Blog
		$conditions = array('Link.parent_id'=>$this->id,
				    'Link.parent_model'=>'Blog');
		
		return $this->Link->updateAll($fields, $conditions);
	}
	

}
?>