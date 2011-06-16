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
	function getTemplateVariable($productsInGroups=array(), $multiple = true) {
		
		$results = array();
		
		foreach($productsInGroups as $key=>$group) {
			$result = array(
					   'id' => $group['ProductGroup']['id'],
					   'title' => $group['ProductGroup']['title'],
					   
					   'description' => $group['ProductGroup']['description'],
					   
					   'handle' => $group['ProductGroup']['handle'],
					   'underscore_handle' => str_replace('-', '_', $group['ProductGroup']['handle']),
					   'url' => $group['ProductGroup']['url'],
					   'all_products_count' => $group['ProductGroup']['visible_product_count'],
					   
					   'vendor_count' => $group['ProductGroup']['vendor_count'],
					   
					);
			
			$result['products'] = isset($group['Product']) ? ProductGroup::getTemplateVariable($group['Product']) : array();
			$result['products_count'] = count($result['products']);
			
			$results[$result['underscore_handle']] = $result;
		}
		
		if (!$multiple && !empty($results)) {
			return current($results);
		} else if (!$multiple && empty($results)) {
			return array();
		}
		
		return $results;
	}
	
	function getVariableForAllProducts($products) {
		
		// need to store all visible and all products in shop
		// need to store all vendors in shop
		
		$result = array(
				'id' => 0,
				'title' => 'all',
				'description' => 'All Products',
				'handle' => 'all',
				'underscore_handle' => 'all',
				'url' => '/collections/all',
				'all_products_count' => '123',
				'vendor_count' => '1',
				
			     );
			
		$result['products'] = $products;
		$result['products_count'] = count($result['products']);
		
		return $result;
	}

}
?>