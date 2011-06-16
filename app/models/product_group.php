<?php
class ProductGroup extends AppModel {
	var $name = 'ProductGroup';
	var $displayField = 'title';
	
	
	var $validate = array(
                   'title' => array('notempty'),
                  );
	
	
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
		),
		'SmartCollectionCondition' => array(
			'className'    => 'SmartCollectionCondition',
			'foreignKey'   => 'smart_collection_id',
			'dependent'    => false,
			'conditions'   => '',
			'fields'       => '',
			'order'        => '',
			'limit'        => '',
			'offset'       => '',
			'exclusive'    => '',
			'finderQuery'  => '',
			'counterQuery' => '',
		),
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
	
	
	/** smart collection methods **/
	
	/**
	* This action is used to save the smart collection
	* 
	* @param array   $data array of data
	* 
	* @return boolean true on successfull execution and false in failure
	*/
	public function saveSmartCollection($data) {
		
		$data['ProductGroup']['type'] = SMART_COLLECTION;
		
		//First create an empty row in smart_collections table
		$this->create();
		//Save posted data in smart_collections table
		if ($this->saveAll($data)) {
			return true;
		}
		return false;
	}//end saveSmartCollection()
	
	
	/**
	* This function is used to save smart collection condition
	* 
	* @param array   $data array of data
	* @param integer $smart_collection_id Smart Collection Id
	* 
	* @return boolean true on successfull execution and false in failure
	*/
	function saveSmartCollectionCondition($data, $smart_collection_id = null) {
		$error = false;
		if (!empty($data['SmartCollectionCondition']) && is_array($data['SmartCollectionCondition'])) {
			if (!$this->__validateSmartCollectionCondition($data['SmartCollectionCondition'])) {
				return false;
			}
		//Check if rows are already present in table for smart_collection_id
		
			if ($smart_collection_id != null) {
				//Get all the records of this smart_collection_id
				$conditions        = array('SmartCollectionCondition.smart_collection_id' => $smart_collection_id);
				$fields            = array('SmartCollectionCondition.id');
				$smart_collections = $this->SmartCollectionCondition->find('all', array(
											'conditions' => $conditions, 
											'fields'     => $fields,
										       ));
				$ids               = Set::extract('{n}.SmartCollectionCondition.id', $smart_collections);
				if (!empty($ids) && count($ids) > 0) {
					//Now we will delete all old ids from table
					$this->SmartCollectionCondition->deleteAll(array('SmartCollectionCondition.id' =>$ids));
				}
			}
			foreach ($data['SmartCollectionCondition'] as $smartCollectionCondtion) {
				//Set smart collection id to array
				$smartCollectionCondtion['smart_collection_id'] = $smart_collection_id;
				$this->SmartCollectionCondition->create();
				if ($this->SmartCollectionCondition->save($smartCollectionCondtion)) {
				//Select all the products with condition selected
				//get products from product model
				//ClassRegistry::init('Product')->conditionalProducts($smartCollectionCondtion);
				$error = true;
				}
			}
			return $error;
		}
		return $error;
	}//end saveSmartCollectionCondition()
	
	
	/**
	* This function is used to save smart collection condition
	* 
	* @param integer $id Smart Collection Id
	* 
	* @return boolean true on successfull execution and false in failure
	*/
	public function getSmartCollectionProducts($smart_collection, $findBy = "all") {
		$tmp = $test = $products = array();
		$tmp['Product.shop_id'] = $smart_collection['ProductGroup']['shop_id'];    
		
		if (!empty($smart_collection['SmartCollectionCondition'])) {
			foreach ($smart_collection['SmartCollectionCondition'] as $smart_collection_condition) {
				$condition = $this->ProductsInGroup->Product->conditionalProducts($smart_collection_condition);
				if (array_key_exists(key($condition), $tmp)) {
				$test[key($condition)][] = $tmp[key($condition)];
				$test[key($condition)][] = $condition[key($condition)];
				}
				$tmp[key($condition)] = $condition[key($condition)];
			}
			if (!empty($test)) {
				foreach ($test as $key => $value) {
					$tmp[$key] = $value;
				}
			}
			$productsOptions = array(
			       'conditions' => $tmp,
			       'contain' => 'ProductImage',
			     );
			
			
			$products = $this->ProductsInGroup->Product->find($findBy, $productsOptions);
			
		}
		return $products;
	}//end getStartCollectionProducts()
	
	
	/**
	* This function is used to validate smart collection condition
	*
	* @return boolean true on successfull execution and false in failure
	*/
	function __validateSmartCollectionCondition($data) {
		if (!empty($data) && is_array($data)) {
			foreach ($data as $value) {
				if ($value['condition'] =="" || $value['condition'] == null) {
					return false;
				}
			}
		}
		return true;
	}//end validateSmartCollectionCondition()

}
?>