<?php
class Post extends AppModel {
	var $name = 'Post';
	var $displayField = 'title';
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Title is required.'
			),
		),
		'content' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Content is required.'
			),
		),
	);


	var $belongsTo = array(
		'Blog' => array(
			'className' => 'Blog',
			'foreignKey' => 'blog_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Author' => array(
			'className' => 'User',
			'foreignKey' => 'author_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'post_id',
			'dependent' => false,
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
	
	var $actsAs = array('Handleize.Sluggable'=> array(
				'fields' => 'title',
				'scope' => array('shop_id'),
				'conditions' => false,
				'slugfield' => 'slug',
				'separator' => '-',
				'overwrite' => false,
				'length' => 150,
				'lower' => true
			),
			    'Visible.Visible',
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
	function getTemplateVariable($articles=array(), $multiple = true) {
		
		$results = array();
		
		if (!$multiple) $articles = array($articles);
		
		foreach($articles as $key=>$article) {
			
			$result = array('id' => $article['Post']['id'],
					   'title' => $article['Post']['title'],
					   
					   'content' => $article['Post']['content'],
					   
					   'handle' => $article['Post']['slug'],
					   'url' => $article['Post']['url'],
					   
					   'created_at' => $article['Post']['created'],
					   );
			
			
			$result['author'] = isset($article['User']['name_to_call']) ? $article['User']['name_to_call'] : '';
			
			
			$results[] = $result;
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