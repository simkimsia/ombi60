<?php
class ProductGroup extends AppModel {
	var $name = 'ProductGroup';
	var $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ProductsInGroup' => array(
			'className' => 'ProductsInGroup',
			'foreignKey' => 'product_group_id',
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
				'slugfield' => 'handle',
				'separator' => '-',
				'overwrite' => false,
				'length' => 150,
				'lower' => true
			),
			    'Visible.Visible',
			    'Handleize.Handleable');
	
	
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id,$table,$ds);
		$this->createVirtualFieldForUrl();
	}
	
	/**
	 * for use in templates for shopfront pages
	 * we avoid the use of many images for retrieving lots of products
	 * */
	function getTemplateVariable($productGroups=array()) {
		
		$results = array();
		
		$this->log($productGroups);
		
		foreach($productGroups as $key=>$group) {
			$result = array('id' => $group['ProductGroup']['id'],
					   'title' => $group['ProductGroup']['title'],
					   
					   'description' => $group['ProductGroup']['description'],
					   
					   'handle' => $group['ProductGroup']['handle'],
					   'url' => $group['ProductGroup']['url'],
					   'products_in_group_count' => $group['ProductGroup']['products_in_group_count'],
					   'vendor_count' => $group['ProductGroup']['vendor_count'],
					   
					   
					   );
			
			
			$results[] = $result;
		}
		
		return $results;
	}

}
?>