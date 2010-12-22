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
		'body' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Body is required.'
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
	
	function beforeValidate() {
		if (!isset($this->data[$this->alias]['slug']) || empty($this->data[$this->alias]['slug'])) {
			$this->data[$this->alias]['slug'] = substr(Inflector::slug(utf8_encode(strtolower($this->data[$this->alias]['title'])), '-'), 0, 150);
		}
		return true;
	}
	
	function beforeSave() {
		if (!isset($this->data[$this->alias]['slug']) || empty($this->data[$this->alias]['slug'])) {
			$this->data[$this->alias]['slug'] = substr(Inflector::slug(utf8_encode(strtolower($this->data[$this->alias]['title'])), '-'), 0, 150);
		}
		
		return true;
	}

}
?>