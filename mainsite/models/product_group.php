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
		
		if (!$multiple) $productsInGroups = array($productsInGroups);
		
		foreach($productsInGroups as $key=>$group) {
			$result = array(
					   'title' => $group['ProductGroup']['title'],
					   
					   'description' => $group['ProductGroup']['description'],
					   
					   'handle' => $group['ProductGroup']['handle'],
					   'underscore_handle' => str_replace('-', '_', $group['ProductGroup']['handle']),
					   'url' => $group['ProductGroup']['url'],
					   'all_products_count' => $group['ProductGroup']['visible_product_count'],
					   
					   'vendor_count' => $group['ProductGroup']['vendor_count'],
					   
					);
			
			$result['products'] = isset($group['Product']) ? Product::getTemplateVariable($group['Product']) : array();
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
	
	
	/** smart collection methods **/
	
	/**
	* This action is used to save the smart collection
	* 
	* @param array   $data array of data
	* 
	* @return boolean true on successfull execution and false in failure
	*/
	public function createSmartCollection($data) {
		
		$data['ProductGroup']['type'] = SMART_COLLECTION;
		
		//First create an empty row in smart_collections table
		$this->create();
		
		//Save posted data in smart_collections table
		$result = $this->saveAll($data);
		
		if ($result) {
			// now we update the ProductsInGroup based on the data
			$data['ProductGroup']['id'] = $this->id;
			$this->smartUpdateProductsInGroup($data);
			return true;
		}
		return false;
	}//end saveSmartCollection()
	
	/**
	 * This function is used to update the ProductsInGroup for Smart Collections
	 *
	 * @param array $smartCollection array of data for the Smart Collection
	 * 				minimum expects the id to exist as ['ProductGroup']['id']
	 * 				otherwise include the actual SmartCollectionCondition data as ['SmartCollectionCondition']
	 * */
	public function smartUpdateProductsInGroup($smartCollection) {
		
		$result = true;
		
		$conditionsExist = isset($smartCollection['SmartCollectionCondition']) && !empty($smartCollection['SmartCollectionCondition']);
		$smartCollectionId = $smartCollection['ProductGroup']['id'];
		// in case there is no conditions, we go and get the conditions!
		if (!$conditionsExist) {
			$this->recursive = -1;
			$this->Behaviors->attach('Containable');
			$smartCollection = $this->find('first', array('conditions'=>array('ProductGroup.id'=>$smartCollectionId, 'ProductGroup.type'=>SMART_COLLECTION),
								      'contain'   =>array('SmartCollectionCondition')));
		}
		
		// first we delete all the ProductsInGroup then we reinsert the records
		// delete all records in ProductsInGroup
		$this->ProductsInGroup->deleteAll(array('ProductsInGroup.product_group_id'=>$smartCollectionId));
		
		// now we format the conditions to seek out all the relevant products
		$conditionsForProducts = $this->formatSmartConditions($smartCollection);
		
		// get all product ids matching said conditions
		$this->ProductsInGroup->Product->recursive = -1;
		
		$products = $this->ProductsInGroup->Product->find('all', array('conditions'=>$conditionsForProducts,
									       'fields'    =>array('Product.id')));
		
		
		// we will insert provided there is at least 1 product that matches the conditions
		if (!empty($products)) {
			$productIDs = Set::extract('{n}.Product.id', $products);
		
			$newProductsInGroup = array();
			foreach($productIDs as $key=>$productID) {
				$newProductsInGroup[] = array('product_id'       => $productID,
							      'product_group_id' => $smartCollectionId);
			}
			
			$result = $this->ProductsInGroup->saveAll($newProductsInGroup);
			
		}
		$productModel = $this->ProductsInGroup->Product;
		
		$productModel->updateCounterCacheForM2M('VisibleProductInGroup', array($smartCollectionId));
		$productModel->updateCounterCacheForM2M('AllProductInGroup', 	 array($smartCollectionId));
		return $result;
	}
	
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
					
					$error = true;
				}
			}
			
			if ($error) {
				$collection = array('ProductGroup'             => array('id'=>$smart_collection_id),
						    'SmartCollectionCondition' => $data['SmartCollectionCondition']);
				$this->smartUpdateProductsInGroup($collection);
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
		$tmp = $this->formatSmartConditions($smart_collection);
		
		$productModel = $this->ProductsInGroup->Product;
		$productModel->recursive = -1;
		$productModel->Behaviors->attach('Containable');
		
		if (!empty($tmp)) {
			
			$productsOptions = array(
			       'conditions' => $tmp,
			       'contain' => 'ProductImage',
			     );
			
			
			$products = $productModel->find($findBy, $productsOptions);
			
		}
		return $products;
	}//end getSmartCollectionProducts()
	
	/**
	 * return the conditions as array for cakephp find function
	 **/
	public function formatSmartConditions($smart_collection, $visibleOrAll = HIDDEN_AND_VISIBLE_ENTITY) {
		$tmp = $test = array();
		$tmp['Product.shop_id'] = Shop::get('Shop.id');
		
		
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
			
			if ($visibleOrAll == VISIBLE_ENTITY) {
				$tmp['Product.visible'] = true;
			} else if ($visibleOrAll == HIDDEN_ENTITY) {
				$tmp['Product.visible'] = false;
			}
		}
		return $tmp;
	}//end formatSmartConditions($smart_collection)
	
	
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
	
	public function getByUrl($handle, $params, $visibleOrAll = VISIBLE_ENTITY) {
		
		// we want to return false if there is no such collection
		// we want to return a collection with conditions for Product->paginate
		// the conditions will be an array inside the collection array with
		// an index of product_paginate
		
		$collection 	= false;
		$handle 	= strtolower($handle);
		
		$viewByProductType 	= ($handle == 'types');
		$viewByVendor 		= ($handle == 'vendors');
		$vendorOrTypeIndicated 	= (isset($params['named']['q']));
		
		// we have 2 situations
		// situation 1 is for automatic collections like a particular vendor or type
		// situation 2 is for regular collections like smart or custom collections
		
		$thisIsAutomaticCollection = (($viewByProductType OR $viewByVendor) AND $vendorOrTypeIndicated);
		
		
		if ($thisIsAutomaticCollection) {
			$collection = $this->getAutomaticCollectionByUrl($handle, $params);
		} else {
			$collection = $this->getRegularCollectionByUrl($handle, $visibleOrAll);
		}
		
		$automaticCollectionForAll = ($collection === false) && ($handle == 'all');
		
		if ($automaticCollectionForAll) {
			$collection = $this->getAutomaticCollectionForAll();
		}
		
		return $collection;
		
	}
	
	/*
	 * get ALL products provided no automatic and regular collections match the handle 'all'
	 * */
	private function getAutomaticCollectionForAll() {
		
		// to retrieve the shop id based on the url
		// see app_controller code and shop model code
		$shop_id = Shop::get('Shop.id');
		
		// create the collection details
		$collection = array('ProductGroup'=>array('title'		=> 'Products',
							  'description'		=> 'All Products',
							  'handle' 		=> 'all',
							  'url'    		=> '/collections/all',
							  'all_product_count'	=> Shop::get('Shop.visible_product_count'),
							  'vendor_count'	=> Shop::get('Shop.vendor_count')));
		
		
		// prepare the pagination of products conditions
		$productPaginate 					 = $this->prepCommonProductPaginate();
		$productPaginate['conditions']['AND']['Product.shop_id'] = $shop_id;
		
		$collection['ProductGroup']['product_paginate'] 	 = $productPaginate;
		
		return $collection;
	}
	
	/*
	 * need to create a table for types and vendors
	 * and include handles for the types and vendors
	 * */
	private function getAutomaticCollectionByUrl($handle, $params) {
		
		if (isset($params['named']['q'])) {
			$nameInParams = $params['named']['q'];			
		} else {
			return false;	
		}
		
		if ($handle == 'types') {
			$typeOrVendorModel = $this->ProductsInGroup->Product->ProductType;
		} elseif ($handle == 'vendors') {
			$typeOrVendorModel = $this->ProductsInGroup->Product->Vendor;
		} else {
			return false;
		}
		
		$typeOrVendorModel->recursive = -1;
		
		// to retrieve the shop id based on the url
		// see app_controller code and shop model code
		$shop_id = Shop::get('Shop.id');
		
		// conditions to get Collection
		$conditionsForCollection = array($typeOrVendorModel->alias.'.handle' =>$nameInParams,
						 $typeOrVendorModel->alias.'.shop_id'=>$shop_id);
		
		
		// does the collection for type or vendor exist?
		$typeOrVendor = $typeOrVendorModel->find('first', array('conditions'=>$conditionsForCollection));
		
		
		
		if ($typeOrVendor) {
			
			$collection = ($handle == 'vendors') ? array('ProductGroup'=>$typeOrVendor['Vendor']) : array('ProductGroup'=>$typeOrVendor['ProductType']);
			
			$collection['ProductGroup']['product_paginate'] = $this->prepProductPaginate4Automatic($typeOrVendor, $handle);
			
			return $collection;
		}
		
		return false;
	}
	
	private function getRegularCollectionByUrl($handle, $visibleOrAll = VISIBLE_ENTITY) {
		
		$this->recursive = -1;
		$this->Behaviors->attach('Containable');
		
		// to retrieve the shop id based on the url
		// see app_controller code and shop model code
		$shop_id = Shop::get('Shop.id');
		
		// conditions to get Collection
		$conditionsForCollection = array('ProductGroup.handle' =>$handle,
						 'ProductGroup.shop_id'=>$shop_id);
		
		
		
		if ($visibleOrAll == VISIBLE_ENTITY) {
			$conditionsForCollection['ProductGroup.visible'] = true;
		}
		
		if ($visibleOrAll == HIDDEN_ENTITY) {
			$conditionsForCollection['ProductGroup.visible'] = false;
		} 
		
		// does the collection exist?
		$collection = $this->find('first', array('conditions'=>$conditionsForCollection,
							 'contain'   =>array('ProductsInGroup')));
		
		
		
		if ($collection) {
			
			$collection['ProductGroup']['product_paginate'] = $this->prepProductPaginate4Regular($collection);
			return $collection;
		}
		
		return false;
		
	}
	
	/**
	 * product paginate conditions for automatic collections like vendors or product types
	 **/
	private function prepProductPaginate4Automatic($collection, $handle) {
		// get the standard paginate stuff like order, variants, etc
		$productPaginate = $this->prepCommonProductPaginate();
		if ($handle == 'types') {
			$productPaginate['conditions']['AND']['Product.product_type_id'] = $collection['ProductType']['id'];	
		}
		
		if ($handle == 'vendors') {
			$productPaginate['conditions']['AND']['Product.vendor_id'] = $collection['Vendor']['id'];	
		}
		
		return $productPaginate;
	}
	
	/**
	 * product paginate conditions for regular collections like smart collections or custom collections
	 * pre determined by the product ids in the ProductsInGroup table
	 **/
	private function prepProductPaginate4Regular($collection) {
		// Extract the product ids in the found collection
                $productIds = Set::extract($collection['ProductsInGroup'], '/product_id');
		// get the standard paginate stuff like order, variants, etc
		$productPaginate = $this->prepCommonProductPaginate();
		// special condition meant only for regular collection
		// regular collection regardless custom or smart uses ProductsInGroup as joint table
		$productPaginate['conditions']['AND']['Product.id'] = $productIds;
		
		return $productPaginate;
	}
	
	/**
	 * assumed that the products you want to paginate are visible
	 * assumed that the conditions BEFORE invoking this will ensure the products are within a single shop
	 * */
	private function prepCommonProductPaginate() {
		$productPaginate = array('conditions'=>array('AND' => array('Product.visible'=>true) ));
		
		$productPaginate['contain'] = array('Variant' => array(
								'order'=>'Variant.order ASC'
							),
						   'ProductImage'=>array(
								'fields' => array('filename'),
								'order'=>array('ProductImage.cover DESC'),
							),
						   //'ProductGroup',
						   'ProductsInGroup'=>array(
								'fields' => array('id', 'product_id'),
								//'conditions' => array('ProductsInGroup.product_id =' => 'Product.id'),
								'ProductGroup'=>array(
									'fields' => array('id', 
											  'title', 'handle',
											  'description', 'visible_product_count',
											  'url', 'vendor_count'),
									//'conditions'=> array('ProductsInGroup.product_group_id =' => 'ProductGroup.id'),
								)));
		
		$productPaginate['link'] = array('Vendor');
		
		// add in the order param into paginate
		// for some weird reason cakephp auto overrides this order when user
		// selects the order based on the named params
		// so basically this is the default order we are setting
		$productPaginate['order'] = array('Product.created DESC');
		
		return $productPaginate;
	}
	
}
?>