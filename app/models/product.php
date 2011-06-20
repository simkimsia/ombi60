<?php
class Product extends AppModel {

	var $name = 'Product';

	// to make it easy for pagination of products, use Linkable and grab 1 product and its 1 cover image
	var $actsAs    = array('Linkable.Linkable',
			       'Copyable.Copyable' => array(
					'habtm' => false,
					'recursive' => false,),
			       'log.Logable',
			       'UnitSystemConvertible',
			       'Handleize.Sluggable'=> array(
					'fields' => 'title',
					'scope' => array('shop_id'),
					'conditions' => false,
					'slugfield' => 'handle',
					'separator' => '-',
					'overwrite' => false,
					'length' => 150,
					'lower' => true
					),
			       'Containable',
			       'Visible.Visible',
			       'Handleize.Handleable',
			       'Many2manyCounterCache'=> array('VisibleProductInGroup'=>array(
								'className' 	=> 'ProductGroup',
								'joinModel' 	=> 'ProductsInGroup',
								'foreignKey'	=> 'product_id',
								'associationForeignKey'	=> 'product_group_id',
								'unique'	=> true,
								'counterCache'  => 'visible_product_count',
								'counterScope'  => array('Product.visible' => 1),
								
								),
							       'AllProductInGroup'=>array(
								'className' 	=> 'ProductGroup',
								'joinModel' 	=> 'ProductsInGroup',
								'foreignKey'	=> 'product_id',
								'associationForeignKey'	=> 'product_group_id',
								'unique'	=> true,
								'counterCache'  => 'all_product_count',
								
								)
							  ),
			       );
	var $recursive = -1;
	
	var $imagesToDelete = array();

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Shop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => 'visible_product_count',
			'counterScope' => array('Product.visible' => 1) 
		),
		'AllProductsInShop' => array(
			'className' => 'Shop',
			'foreignKey' => 'shop_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => 'all_product_count',
		),
		'Vendor' => array(
			'className' => 'Vendor',
			'foreignKey' => 'vendor_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => 'visible_product_count',
			'counterScope' => array('Product.visible' => 1) 
		),
		'AllProductsInVendor' => array(
			'className' => 'Vendor',
			'foreignKey' => 'vendor_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => 'all_product_count',
		),
		'ProductType' => array(
			'className' => 'ProductType',
			'foreignKey' => 'product_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => 'visible_product_count',
			'counterScope' => array('Product.visible' => 1) 
		),
		'AllProductsInProductType' => array(
			'className' => 'ProductType',
			'foreignKey' => 'product_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => 'all_product_count',
		),
		
	);

	var $hasMany = array(
		'ProductImage' => array(
			'className' => 'ProductImage',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => true,
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CartItem' => array(
			'className' => 'CartItem',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => false,
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'OrderLineItem' => array(
			'className' => 'OrderLineItem',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => false,
			'finderQuery' => '',
			'counterQuery' => ''
		),
		
		'ProductsInGroup' => array(
			'className' => 'ProductsInGroup',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Variant' => array(
			'className' => 'Variant',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ProductOption' => array(
			'className' => 'ProductOption',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),

	);
	
	
	var $validate = array(
			      'title' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => 'Product title cannot be empty',
					
							),)
			     );
	
	
	public function __construct($id=false,$table=null,$ds=null) {
		parent::__construct($id,$table,$ds);
		$this->createVirtualFieldForUrl();
	}
	
	
	/**
	 * For unit conversion
	 * */
	function afterFind($results, $primary) {
		
                $unit = Shop::get('ShopSetting.unit_system');
		
		foreach ($results as $key => $val) {
			if (isset($val['Product'])) {
				$results[$key] = $this->convertForDisplay($val, $unit);
			}
			/** this is for the Products In Custom Collection **/
			if (isset($val['ProductsInGroup'])) {
				// we assume Containable was used to retrieve the records
				/**
				 * [ProductsInGroup] => Array
					(
					    [0] => Array
						(
						    [id] => 1
						    [product_id] => 4
						    [product_group_id] => 2
						)
				
					    [1] => Array
						(
						    [id] => 2
						    [product_id] => 4
						    [product_group_id] => 3
						)
				
					) */
				$groups = Set::extract('ProductsInGroup.{n}.product_group_id', $val);
				$results[$key]['Product']['selected_collections'] = $groups;
			}
		}
		
		
		return $results;
	}
	
	/**
	 * For unit conversion
	 * */
	function beforeSave() {
		
                $unit = Shop::get('ShopSetting.unit_system');
		
		foreach ($this->data as $key => $val) {
			if (isset($val['Product'])) {
				$this->data[$key] = $this->convertForSave($val, $unit);
			}
			if ($key == 'Product') {
				$resultingProductArray = $this->convertForSave(array($key => $this->data[$key]), $unit);
				$this->data[$key] = $resultingProductArray[$key];
			}
		}
		
		return true;
	}
	
	/**
	 * will return the product url based on id
	 * otherwise return the shop url
	 * **/
	function getProductUrl($id = false) {
		
		if (!$id) {
			$id = $this->id;
		}
		
		if (is_numeric($id) && ($id > 0)) {
			return Router::url(array('controller'=>'products',
					  'action'=>'view',
					  $id), true);
		}
		
		return FULL_BASE_URL;
		
	}

	function createProductDetails($data = NULL) {

		$image = $this->ProductImage;

		if (!empty($data['ProductImage']) AND is_array($data['ProductImage'])) {
			$firstValidImage = true;
			foreach ($data['ProductImage'] as $key => $value) {
				if (is_array($value) AND ($value[$image->defaultNameForImage]['error'] === UPLOAD_ERR_NO_FILE)) {
					unset($data['ProductImage'][$key]);
				} elseif ($firstValidImage) {
					// we make the first image for this new product its default cover
					$data['ProductImage'][$key]['cover'] = true;
					$firstValidImage                     = false;
				}
			}

			if (empty($data['ProductImage'])) {
				unset($data['ProductImage']);
			}
		}
		
		$variantTitle = VARIANT_DEFAULT_TITLE;
		$variantOptions = array();
		if (!empty($data['Variant'][0]['VariantOption'])) {
			$variantTitle = '';
			// set the order of the 1st variant's options
			foreach($data['Variant'][0]['VariantOption'] as $key=>$option) {
				$variantTitle .= $option['value'] . ' /';
			}
			
			$variantTitle = rtrim($variantTitle, " /");
			
			$variantOptions = $data['Variant'][0]['VariantOption'];
		}
		
		// add in the default variant
		$data['Variant'][0] = $data['Product'];
		$data['Variant'][0]['title'] = $variantTitle;
		$data['Variant'][0]['sku_code'] = $data['Product']['code'];
		$data['Variant'][0]['order'] = 0;

		$result = $this->saveAll($data, array('validate'=>'first',
						      'atomic' => false));
		
		// now we need to save the variant options
		if ($result) {
			$variantID = $this->Variant->getLastInsertId();
			$data['Variant'][0]['id'] = $variantID;
			
			$variantData = array('Variant'		=> $data['Variant'][0],
					     'VariantOption'	=> $variantOptions);
			$result = $this->Variant->saveAll($variantData);
		}
		
		return $result;

	}
	
	function duplicate($id = NULL, $parentIDs = array()) {
		// this product model is copied but NOT recursively.
		$result = $this->copy($id);

		// now we need to duplicate all the related product images
		if ($result) {
			// first we need to retrieve all the ProductImages belonging to the original Product
			$this->ProductImage->recursive = -1;
			$images = $this->ProductImage->find('all', array(
							'conditions' => array('product_id' => $id),
							'fields' => array('ProductImage.filename',
									  'ProductImage.cover')
							));

			// duplicate the images 1 by 1
			foreach ($images as $key=>$image) {
				$duplicateSuccessful = $this->ProductImage->duplicateImage(PRODUCT_IMAGES_PATH . $image['ProductImage']['filename']);

				if ($duplicateSuccessful) {
					// copy the values of cover and product_id
					$this->ProductImage->data['ProductImage']['cover']      = $image['ProductImage']['cover'];
					$this->ProductImage->data['ProductImage']['product_id'] = $this->id;

					$data = $this->ProductImage->data;

					// because we are creating new ProductImage so we need to run this command.
					$this->ProductImage->create();

					// because the MeioUpload behavior will generate errors in this form
					// [filename] => There were problems in uploading the file.
					// due to the function uploadCheckUploadError, hence we need to set the validate to false
					// we also need to set the callbacks to false because of the validations actions in the callbacks as well.
					$result = $this->ProductImage->save($data, array('validate'=>false,
											 'callbacks'=>false));

				}

			}
			
			// duplicate the custom collections the product is in
			$this->ProductsInGroup->recursive = -1;
			$groups = $this->ProductsInGroup->find('all', array(
							'conditions' => array('product_id' => $id),
							'fields' => array('ProductsInGroup.product_group_id')
							));
			
			$duplicateGroups = Set::extract('{n}.ProductsInGroup.product_group_id', $groups);
			$this->saveIntoCollections($this->id, $duplicateGroups);
			
			// duplicate the variants as well.
			// first we need to retrieve all the Variants belonging to the original Product
			$variants = $this->Variant->find('all', array(
							'conditions' => array('product_id' => $id),
							));

			// duplicate all the variants
			foreach($variants as $key=>$variant) {
				// remove current ids for variants
				unset($variants[$key]['Variant']['id']);
				// replace product_ids for variants
				$variants[$key]['Variant']['product_id'] = $this->id;
			}
			
			// nowe we prepare the saveAll
			$variants = Set::extract('{n}.Variant', $variants);
			
			$variantDupeResult = $this->Variant->saveAll($variants);
			
			
		}

		// this is to copy the product to another shop, vendor, product type or any other parent model
		// that the product belongs to
		// most likely to be solely used for the dummy first product of a newly created shop
		foreach ($parentIDs as $field=>$value) {
			$this->set($field, $value);
		}
		if (!empty($parentIDs)) {
			return $this->save();
		}
		
		return $result;
	}
	
	// did this callback to ensure images of products are also deleted
	// first assign class variable imagesToDelete with list of filenames
	function beforeDelete($cascade) {
                
		$images = $this->ProductImage->find('all', array('conditions'=>array('product_id'=>$this->id),
						       'fields'=>array('ProductImage.id', 'ProductImage.filename')));
		
		$this->imagesToDelete = Set::extract('/ProductImage/filename', $images);
		
		return true;
        }
        
	// same motive as beforeDelete
	// this will do the actual deletion using unlink
        function afterDelete() {
                
		// secure way of finding out the possible thumbnail folder names
		// basically i pr($this->ProductImage->Behaviors) in order to get this.
		$thumbnailFolders = array_keys($this->ProductImage->Behaviors->MeioDuplicate->__fields['ProductImage'][$this->ProductImage->defaultNameForImage]['thumbsizes']);
		
                foreach ($this->imagesToDelete as $key => $value) {
			// delete original image
                        $origFile = PRODUCT_IMAGES_PATH . $value;
			if (file_exists($origFile)) {
				unlink($origFile);
			}
			// delete all possible thumbnails
			foreach($thumbnailFolders as $thumbFolder) {
				$thumbNail = PRODUCT_IMAGES_THUMB_PATH 	. DS . $thumbFolder . DS . $value;
				if (file_exists($thumbNail)) {
					unlink($thumbNail);
				}
			}
			
                }
		
		$this->updateCounterCacheForM2MMain($this->id);
		
		
        }
	
	function afterSave($created) {
		
		/** set up the product image **/
		$conditions = array(
			      'conditions' => array('OR' =>
							array (
								array('ProductImage.cover'=>true),
								array('ProductImage.cover'=>null),
							),
						    ),
			      'link'=>array('ProductImage'),
			      'fields'=>array('Product.id', 'ProductImage.id'),
			      );
		$conditions['conditions']['AND'] = array('Product.id' => $this->id);
		
		$results = $this->find('all', $conditions);
		if (empty($results)) {
			$this->ProductImage->recursive = -1;
			$topImage = $this->ProductImage->find('all', array('conditions'=>array('product_id'=>$this->id),
							       'fields'=>array('ProductImage.id'),
							       'limit'=>1));
			
			$this->ProductImage->make_this_cover($topImage[0]['ProductImage']['id'], $this->id);
		}
		/** end of product images **/
		
		
		/** update cart_items weight and price **/
		if (!$created) {
			if (isset($this->data['Product']['price']) &&
			    isset($this->data['Product']['weight'])) {
				$this->CartItem->updatePricesAndWeights($this->id, $this->data['Product']['price'],
								'SGD',
								$this->data['Product']['weight'],
								'kg');
			}
			
			if(isset($this->data['Product']['shipping_required']) &&
			   isset($this->data['Product']['original_shipping_required'])) {
				
				if ($this->data['Product']['shipping_required'] != $this->data['Product']['original_shipping_required']) {
					
					$this->CartItem->toggleByConditions(array('CartItem.product_id'=>$this->data['Product']['product_id']), 'shipping_required');
						
				}
				
			}
		}
		
		
		/** end of cart_items weight and price **/
		
		/** Associate this product with custom collections **/
		$customCollectionsJoined = (!empty($this->data['Product']['selected_collections'])) ? $this->data['Product']['selected_collections'] : array();
		
		$this->saveIntoCollections($this->id, $customCollectionsJoined);	
		
		
		/** update smart collections **/
		$product 	= $this->data['Product'];
		$product['id'] 	= $this->id;
		$this->smartUpdateProductsInGroup($product);
		
	}
	
	/**
	 * for use in templates for shopfront pages
	 * */
	function getTemplateVariable($products=array(), $multiple = true) {
		
		$results = array();
		
		if (!$multiple) $products = array($products);
		
		foreach($products as $key=>$product) {
			
			$images = Set::extract('ProductImage.{n}.filename', $product);
			$variants = Set::extract('Variant.{n}', $product);
			
			$result = array('id' => $product['Product']['id'],
					   'title' => $product['Product']['title'],
					   'code' => $product['Product']['code'],
					   'description' => $product['Product']['description'],
					   'price' => $product['Product']['price'],
					   'handle' => $product['Product']['handle'],
					   'underscore_handle' => str_replace('-', '_', $product['Product']['handle']),
					   'url' => $product['Product']['url'],
					   
					   'weight' => $product['Product']['weight'],
					   );
			
			
			$result['images'] = $images;
			$result['cover_image'] = isset($images[0]) ? $images[0] : '';
			$result['vendor'] = isset($product['Vendor']['name']) ? $product['Vendor']['name'] : '';
			$result['variants'] = Variant::getTemplateVariable($variants);
			
			$result['collections'] = isset($product['ProductsInGroup']) ? ProductGroup::getTemplateVariable($product['ProductsInGroup']) : array();
			
			$results[$result['underscore_handle']] = $result;
		}
		
		if (!$multiple && !empty($results)) {
			return current($results);
		} else if (!$multiple && empty($results)) {
			return array();
		}
		
		return $results;
	}
	
	function saveIntoCollections ($id, $customCollections = array()) {
		/**
		if (empty($customCollections)) {
			return true;
		}
		**/
		
		$this->ProductsInGroup->recursive = -1;
		
		$associations = $this->ProductsInGroup->find('all', array(
							'conditions'=> array('ProductsInGroup.product_id' => $id),
							'fields'=> array('ProductsInGroup.product_group_id')
							));
		
		
		
		/**
		 * Array
			(
			    [0] => Array
				(
				    [ProductsInGroup] => Array
					(
					    [product_group_id] => 2
					)
			
				)
			
			    [1] => Array
				(
				    [ProductsInGroup] => Array
					(
					    [product_group_id] => 3
					)
			
				)
			
			)
			
		*/
		$existingGroups = Set::extract('{n}.ProductsInGroup.product_group_id', $associations);
		

		/** existingGroups from here and customCollections from the view look like this **/
		//Array
		//(
		//    [0] => 2
		//    [1] => 3
		//)
		
		// do some array_diff to get new records
		$newRecords = array_diff($customCollections, $existingGroups);
		
		// do some array_diff to get deleted records
		$deletedRecords = array_diff($existingGroups, $customCollections);
		
		// combined union of the unique values
		$unionRecords = array_unique(array_merge($customCollections, $existingGroups));
		
		// check if we need to insert new records
		// AND/OR delete old records
		$newRecordsOn = !empty($newRecords);
		$deletedRecordsOn = !empty($deletedRecords);
		$doTransaction = ($newRecordsOn OR $deletedRecordsOn);
		
		
		
		// build the $data to save $newRecords
		if ($newRecordsOn) {
			$data = array('ProductsInGroup' => array());
			foreach($newRecords as $key=>$groupId) {
				$data['ProductsInGroup'][] = array(
								'product_group_id'=>$groupId,
								'product_id' => $id);
			}
		}
		
		
		// save the new records
		// and delete the deleted records
		// using transaction
		// provided we need to do so
		if ($doTransaction) {
			// create the datasource
			$datasource = $this->getDataSource();
			
			// start transaction
			$datasource->begin($this);
	
			$result = true;
			
			if ($newRecordsOn) {
				$result = $this->ProductsInGroup->saveAll($data['ProductsInGroup'], array('validate'=>'first',
													  'atomic'=>false));
				
	
				if (!$result) {
					$datasource->rollback($this);
					return false;
				}	
			}
			
			if ($deletedRecordsOn) {
				
				$result = $this->ProductsInGroup->deleteAll(array('ProductsInGroup.product_group_id'=>$deletedRecords,
									'ProductsInGroup.product_id' => $id));
				
				if (!$result) {
					$datasource->rollback($this);
					return false;
				}
				
			}
			
			// finally we commit if everything is okay!
			if ($result) {
				
				$datasource->commit($this);
				
				
			}
			
			// now we call the Many2manyCounterCache->_updateCounterCache
			$this->updateCounterCacheForM2MMain($id, $unionRecords);
			
			return $result;
		}
		
		// now we call the Many2manyCounterCache->_updateCounterCache
		$this->updateCounterCacheForM2MMain($id, $unionRecords);
		
		return true;
	}
	
	function updateCounterCacheForM2MMain($id, $groupIds=array(), $updateAllCount=true) {
		if (empty($groupIds)) {
			$associations = $this->ProductsInGroup->find('all', array(
							'conditions'=> array('ProductsInGroup.product_id' => $id),
							'fields'=> array('ProductsInGroup.product_group_id')
							));
			
			$groupIds = Set::extract('{n}.ProductsInGroup.product_group_id', $associations);
		}
		$this->id = $id;
		
		$this->updateCounterCacheForM2M('VisibleProductInGroup', $groupIds);
		if ($updateAllCount) {
			$this->updateCounterCacheForM2M('AllProductInGroup', $groupIds);	
		}
		
		
	}

	public function conditionalProducts($conditionalArray, $fields = array('Product.id')) {
		$conditions = "";
		$field      = $conditionalArray['field'];
		$relation   = $conditionalArray['relation'];
		$value      = $conditionalArray['condition'];
		switch ($relation) :
			case "equals":
			  //Field should be exactly equal to Value
			  $conditions = array($field => $value);
			  break;
			case "starts_with":
			  //Field should start with Value
			  $conditions = array($field . " LIKE '".$value."%'");
			  break;
			case "ends_with":
			  //Field should end with value
			  $conditions = array($field . " LIKE '%".$value."'");
			  break;
			case "contains":
			  //Field should contain the value
			  $conditions = array($field . " LIKE '%".$value."%'");
			  break;        
			case "greater_than":
			  //Field should contain the value
			  $conditions = array($field . " > "=> $value);
			  break;
			case "less_than":
			  //Field should contain the value
			  $conditions = array($field . " < "=> $value);
			  break;
		endswitch;
		return $conditions;
		//First check whick type of 
		//return ($this->find('all', array('conditions' => $conditions/*, 'fields' => $fields*/)));
	}//end conditionalProducts()
	
	
	/**
	 * @param array $product this is the associative array of the product without Product index present
	 * @param array $conditionalArrays this must be a numerically indexed array of the conditions
	 *  that is the list of conditions without SmartCollectionCondition index present
	 * */
	private function evaluateAgainstSmartConditions($product, $conditionalArrays) {
		$ok = true;
		
		foreach($conditionalArrays as $conditionalArray) {
			$field      = str_replace('Product.', '', $conditionalArray['field']);
			$relation   = $conditionalArray['relation'];
			$value      = $conditionalArray['condition'];
			
			$fieldInProduct = $product[$field];
			
			// assume case-insensitive for now
			
			switch ($relation) :
				case "equals":
				  //Field in Product should be exactly equal to Value
				  if (is_numeric($value)) {
					$ok = ($fieldInProduct == $value);
				  } else if(is_string($value)) {
					
					$ok = (strcasecmp($fieldInProduct,$value) == 0);	
				  } else {
					$ok = false;
				  }
				  break;
				case "starts_with":
				  //Field in Product should start with Value
				  $ok = startsWith($fieldInProduct, $value,  false);
				  break;
				case "ends_with":
				  //Field in Product should end with value
				  $ok = endsWith($fieldInProduct, $value, false);
				  break;
				case "contains":
				  //Field in Product should contain the value
				  $ok = (stripos($fieldInProduct, $value) !== false);
				  break;        
				case "greater_than":
				  //Field in Product is greater than the value
				  $ok = ($fieldInProduct > $value);
				  break;
				case "less_than":
				  //Field in Product is less than the value
				  $ok = ($fieldInProduct < $value);
				  break;
			endswitch;
			
			if ($ok == false) {
				break;
			}
		}
		return $ok;
	}
	
	/**
	 * This function is used to update the ProductsInGroup for Smart Collections
	 *
	 * @param array $product this is the associative array of the product without Product index present
	 * */
	public function smartUpdateProductsInGroup($product) {
		
		$result = true;
		
		$collectionModel = $this->ProductsInGroup->ProductGroup;
		$collectionModel->recursive = -1;
		$collectionModel->Behaviors->attach('Containable');
			
		$smartCollections = $collectionModel->find('all', array('conditions'=>array('ProductGroup.shop_id'=>Shop::get('Shop.id'),
											    'ProductGroup.type'=>SMART_COLLECTION),
									'contain'   =>array('SmartCollectionCondition')));
		
		$smartCollectionIDs = Set::extract('{n}.ProductGroup.id', $smartCollections);
		
		// first we delete all the ProductsInGroup then we reinsert the records
		// delete all records in ProductsInGroup
		$this->ProductsInGroup->deleteAll(array('ProductsInGroup.product_id'	   => $product['id'],
							'ProductsInGroup.product_group_id' => $smartCollectionIDs));
		
		$productsInGroups = array();
		
		// now we format the conditions to seek out all the relevant collection
		foreach($smartCollections as $key=>$smartCollection) {
			// use php functions for evaluations
			$ok = $this->evaluateAgainstSmartConditions($product, $smartCollection['SmartCollectionCondition']);
			if ($ok) {
				$productsInGroups[] = array('product_id'       => $product['id'],
							    'product_group_id' => $smartCollection['ProductGroup']['id']);
			}
		}
		
		// we will insert provided there is at least 1 product that matches the conditions
		if (!empty($productsInGroups)) {
			$result = $this->ProductsInGroup->saveAll($productsInGroups);
		}
		
		$this->updateCounterCacheForM2M('VisibleProductInGroup', $smartCollectionIDs);
		$this->updateCounterCacheForM2M('AllProductInGroup', 	 $smartCollectionIDs);
		return $result;
	}


}//end class