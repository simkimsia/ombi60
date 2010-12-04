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
	
	function beforeValidate() {
		if (!isset($this->data[$this->alias]['handle']) || empty($this->data[$this->alias]['handle'])) {
			$this->data[$this->alias]['handle'] = substr(Inflector::slug(utf8_encode(strtolower($this->data[$this->alias]['title'])), '-'), 0, 150);
		}
		return true;
	}
	
	function beforeSave() {
		if (!isset($this->data[$this->alias]['handle']) || empty($this->data[$this->alias]['handle'])) {
			$this->data[$this->alias]['handle'] = substr(Inflector::slug(utf8_encode(strtolower($this->data[$this->alias]['title'])), '-'), 0, 150);
		}
		
		return true;
	}
}
?>