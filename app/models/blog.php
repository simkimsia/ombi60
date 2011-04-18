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

}
?>