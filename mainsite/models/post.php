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
			'order' => '',
			'counterCache' => 'visible_post_count',
			'counterScope' => array('Post.visible' => 1) // only count if "article" is visible = 1
		),
		'BlogAllPost' => array(
			'className' => 'Blog',
			'foreignKey' => 'blog_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => 'all_post_count',
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
		$this->createUrlForArticle();
	}
	
	function createUrlForArticle() {
                
                $controller = 'blogs';
                $action = 'view';
                
                
		if (!isset($this->virtualFields['url'])) {
                        
                        $this->virtualFields['url'] = "CONCAT('/', '$controller', '/', `Blog`.`short_name`, '/', `{$this->alias}`.`id`, '-', `{$this->alias}`.`slug`)";
                                
                }
                
	}
	
	
	/**
	 * use this method ONLY after toggle!!
	 **/
	function updatePublishedAt($id) {
		
		return $this->updateAll(
			// fields to change
                        // this should give array('Product.visible' => '!Product.visible')
			 array('published' => date('Y-m-d')),
			 // conditions
                         // this should like array('Product.id' => $id)
			 array('Post.id' => $id, 'Post.visible'=>true)
		);
		
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
					   'underscore_handle' => str_replace('-', '_', $article['Post']['slug']),
					   'url' => $article['Post']['url'],
					   
					   'created' => $article['Post']['created'],
					   'published'=> $article['Post']['published'],
					   );
			
			
			$result['author'] = isset($article['User']['name_to_call']) ? $article['User']['name_to_call'] : '';
			
			
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