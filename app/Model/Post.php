<?php
class Post extends AppModel {
	public $name = 'Post';
	public $displayField = 'title';
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $validate = array(
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


	public $belongsTo = array(
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

	public $hasMany = array(
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
	
	public $actsAs = array('Handleize.Sluggable'=> array(
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
	
	public function createUrlForArticle() {
                
                $controller = 'blogs';
                $action = 'view';
                
                
		if (!isset($this->virtualFields['url'])) {
                        
                        $this->virtualFields['url'] = "CONCAT('/', '$controller', '/', `{$this->alias}`.`blog_handle`, '/', `{$this->alias}`.`id`, '-', `{$this->alias}`.`slug`)";
                                
                }
                
	}
	
	
	/**
	 * use this method ONLY after toggle!!
	 **/
	public function updatePublishedAt($id) {

		return $this->updateAll(
			// fields to change
                        // this should give array('Product.visible' => '!Product.visible')
			 array('Post.published' => "'" . date('Y-m-d H:i:s') . "'"),
			 // conditions
                         // this should like array('Product.id' => $id)
			 array('Post.id' => $id, 'Post.visible'=>true)
		);
		
	}
	
	/**
	 * for use in templates for shopfront pages
	 * */
	public function getTemplateVariable($articles=array(), $multiple = true) {
		
		$results = array();
		
		if (!$multiple) $articles = array($articles);
		
		foreach($articles as $key=>$article) {
			$author = isset($article['User']['name_to_call']) ? $article['User']['name_to_call'] : '';
			$article = !empty($article['Post']) ? $article['Post'] : $article;
			$result = array('id' => $article['id'],
					   'title' => $article['title'],
					   
					   'content' => $article['content'],
					   
					   'handle' => $article['slug'],
					   'underscore_handle' => str_replace('-', '_', $article['slug']),
					   'url' => $article['url'],
					   
					   'created' => $article['created'],
					   'published'=> $article['published'],
					   );
			
			
			$result['author'] = $author;
			
			
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
	
	public function beforeSave($options) {
		
		// assuming we do not do a saveAll for Post
		// or a saveAll from its parent model Blog
		$setBlogHandle = (empty($this->data['Post']['blog_handle']));
		
		if ($setBlogHandle) {
			if (!empty($this->data['Blog']['short_name'])) {
				$this->data['Post']['blog_handle'] = $this->data['Blog']['short_name'];
			} elseif (!empty($this->data['Post']['blog_id'])) {
				$this->Blog->id = $this->data['Post']['blog_id'];
				$this->data['Post']['blog_handle'] = $this->Blog->field('short_name');
			} else {
				$this->data['Post']['blog_handle'] = 'news';
			}
		}
		
		return true;
		
	}
	

}
?>