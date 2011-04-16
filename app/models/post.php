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
	
	var $actsAs = array('Sluggable'=> array(
				'fields' => 'title',
				'scope' => array('shop_id'),
				'conditions' => false,
				'slugfield' => 'slug',
				'separator' => '-',
				'overwrite' => false,
				'length' => 150,
				'lower' => true
			),
			    'Visible.Visible',);
	

}
?>