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
	
	function beforeValidate() {
		// ensure short_name is set
		if (!isset($this->data[$this->alias]['short_name']) || empty($this->data[$this->alias]['short_name'])) {
			$this->data[$this->alias]['short_name'] = substr(Inflector::slug(utf8_encode(strtolower($this->data[$this->alias]['title'])), '-'), 0, 100);
		}
		// ensure shop_id is set
		if (!isset($this->data[$this->alias]['shop_id']) || empty($this->data[$this->alias]['shop_id'])) {
			$this->data[$this->alias]['shop_id'] = Shop::get('Shop.id');
		}
		
		return true;
	}
	
	function beforeSave() {
		// ensure short_name is set
		if (!isset($this->data[$this->alias]['short_name']) || empty($this->data[$this->alias]['short_name'])) {
			$this->data[$this->alias]['short_name'] = substr(Inflector::slug(utf8_encode(strtolower($this->data[$this->alias]['title'])), '-'), 0, 100);
		}
		
		// ensure shop_id is set
		if (!isset($this->data[$this->alias]['shop_id']) || empty($this->data[$this->alias]['shop_id'])) {
			$this->data[$this->alias]['shop_id'] = Shop::get('Shop.id');
		}
		
		return true;
	}

}
?>