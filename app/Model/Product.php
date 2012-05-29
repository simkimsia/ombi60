<?php
class Product extends AppModel {

	public $name = 'Product';

	// to make it easy for pagination of products, use Linkable and grab 1 product and its 1 cover image
	public $actsAs = array(
		'Linkable.Linkable',
		'Copyable.Copyable' => array(
			'habtm' => false,
			'recursive' => false,
		),
       'Log.Logable',
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
       'ManyToManyCountable.ManyToManyCountable' => array(
			'LinkList'=>array(
				'className' 	=> 'LinkList',
				'joinModel' 	=> 'Link',
				'foreignKey'	=> 'parent_id',
				'associationForeignKey'	=> 'link_list_id',
				'unique'	=> true,
				'counterCache'  => 'link_count',
				'foreignScope' => array('Link.parent_model' => 'Product'),
			),
		
			'VisibleProductInGroup'=>array(
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
	
	public $recursive = -1;
	
	public $imagesToDelete = array();
	
	public $optionModel = '';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
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

	public $hasMany = array(
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
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'parent_id',
			'dependent' => true,
			'conditions' => array('Link.parent_model' => 'Product'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
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
			'className' => 'VariantModel',
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
		'CustomPrint' => array(
			'className' => 'CustomPrint',
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
	
	
	public $validate = array(
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
	public function afterFind($results, $primary) {
		
        $unit = Shop::get('ShopSetting.unit_system');
		if ($primary) {
			foreach ($results as $key => $val) {
				
				if (isset($val['Product'])) {
					$results[$key] = $this->convertForDisplay($val, $unit, $primary);
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
					
						) 
						**/
					$groups = Set::extract('ProductsInGroup.{n}.product_group_id', $val);
					$results[$key]['Product']['selected_collections'] = $groups;
				}
			}
			
		} else {
			
			// in this case, we do not get back a {n}.{ModelName}.{field} format for results
			// we got back an array of {field} directly
			$results = $this->convertForDisplay($results, $unit, $primary);
			if (isset($results['ProductsInGroup'])) {
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
				
					) 
					**/
				$groups = Set::extract('ProductsInGroup.{n}.product_group_id', $results);
				$results['selected_collections'] = $groups;
			}
		}
		
		return $results;
	}
	
	/**
	 * For unit conversion
	 * */
	public function beforeSave() {
		
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
	 * Prepares data for a newly created Product and the associated models.
	 * The newly created Product will have 1 Variant and its list of VariantOption created as well.
	 *
	 * @param array $data The associative array with the following expected indices:
	 * Product, ProductImage, Variant, Variant.{n}.VariantOption
	 * The Product index points to an array of Product data fields.
	 * The ProductImage and Variant indices point to lists of ProductImage and Variant.
	 * A list of VariantOption is expected in each element of the Variant list.
	 *
	 * @return boolean Returns true if the newly created Product and associated models are saved. False otherwise.
	 * 
	 **/
	public function createDetails($data = NULL) {
		$this->create();
		
		
		/** 
		* because of ChildLabel.com request, 
		* we want to juggle between custom_print_image and product_images 
		* so we flush out the product_images original data and store it with custom_print_image
		*/
		if (!empty($data['Product']['custom_print_on'])) {
			if (!empty($_FILES['custom_print_image']) && !empty($_FILES['product_images'])) {
				foreach($_FILES['product_images'] as $attr=>$value) {
					$_FILES['product_images'][$attr] = array();
					$_FILES['product_images'][$attr][] = $_FILES['custom_print_image'][$attr];
				}		
				// need to declare the CustomPrint inside the data variable otherwise
				// CustomPrint data will not be saved.
				// at the very minimum should declare CustomPrint.0 as empty array	
				$data['CustomPrint'][0]['options'] = 'options data';
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

	}//end createDetails()
	
	public function duplicate($id = NULL, $parentIDs = array()) {
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

			if (!empty($duplicateGroups)) {
				$this->saveIntoCollections($this->id, $duplicateGroups);				
			}
			
			// duplicate the variants as well.
			// first we need to retrieve all the Variants belonging to the original Product
			$this->Variant->recursive = -1;
			$this->Variant->Behaviors->load('Containable');
			$variants = $this->Variant->find('all', array(
							'conditions'	=> array('product_id' => $id),
							'contain'	=> array('VariantOption')
							));

			$variantDupeResult = true;
			
			// duplicate all the variants
			foreach($variants as $key=>$variant) {
				// remove current ids for variants
				unset($variant['Variant']['id']);
				// replace product_ids for variants
				$variant['Variant']['product_id'] = $this->id;
				// remove the variant_id, id inside the option
				foreach($variant['VariantOption'] as $optionKey => $option) {
					unset($variant['VariantOption'][$optionKey]['variant_id']);
					unset($variant['VariantOption'][$optionKey]['id']);
				}
				
				// now we do the saveAll for each variant and its options
				$variantDupeResult = $this->Variant->saveAll($variant);
				if ($variantDupeResult == false) {
					break;
				}
			}
			
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
	public function beforeDelete($cascade) {
                
		$images = $this->ProductImage->find('all', array('conditions'=>array('product_id'=>$this->id),
						       'fields'=>array('ProductImage.id', 'ProductImage.filename')));
		
		$this->imagesToDelete = Set::extract('/ProductImage/filename', $images);
		
		return true;

	}
        
	// same motive as beforeDelete
	// this will do the actual deletion using unlink
   	public function afterDelete() {
                
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
	
	/**
	 *
	 * Update the VariantOptions belonging to a Product.
	 * Option field names may be changed. Option may be deleted if that option has only 1 possible value.
	 * 
	 * 
	 * @param array $data Product array.
	 * 
	 * Expected values are $data['Product']['new_options'], (optional)
	 * $data['Product']['options'],$data['Product']['id'],
	 * (both compulsory) are expected.
	 *
	 * $data['Product']['new_options'] is a numerically indexed array
	 * [0] => array[
			[field] => title/style/custom/...
			[custom_field] => whatever the custom field
			[value] => the default value
		 ],
	   [1] => array[
		...
		],
	   ...
		 
	 * $data['Product']['options'] is an associative indexed array
	 * the index is the original field name
	 * ['size'] => array[
	 * 		[new_custom_field] => batteries, // if we want to rename the custom field
			[new_field] => color, // if we want to rename the field, this will be different from the index
			[delete] => 1, // if we wish to remove this option, this will be set as delete = 1
			[order] => 0, // the original order value 
		 ],
	   [title] => array[
		...
		],
	   ...
	   
	   **/
	public function updateOptions($data) {
		$currentOptions = !empty($data['Product']['options']) ? $data['Product']['options'] : array();
		$newOptions 	= !empty($data['Product']['new_options']) ? $data['Product']['new_options'] : array();
		
		// extract only deleted current options
		$deleteCurrentOptions = array();
		$validCurrentOptions = array();
		foreach($currentOptions as $originalField => $option) {
			if (!empty($option['delete']) && $option['delete'] == 1) {
				$deleteCurrentOptions[$originalField] = $option;
			} else {
				$validCurrentOptions[$originalField] = $option;
			}
		}
		
		// we need to have at least 1 Product Option
		if (!empty($data['Product']['id']) && (!empty($validCurrentOptions) || !empty($newOptions))) {
			$productID = $data['Product']['id'];
			// retrieve all the current Product Variants
			$variantIDs = $this->Variant->find('list', array('conditions'=>array('Variant.product_id' => $productID),
								         'fields'    =>array('Variant.id')));
			
			/**
			 * the order is very important!!
			 * we need to allow new options which in case are the same as the old option fields
			 **/
			// delete any current options
			$this->deleteAllOptions($deleteCurrentOptions, $variantIDs);
			// add new Product options
			$this->addNewProductOptions($productID, $newOptions, $variantIDs);
			// rename any current options
			$this->renameOptionFields($validCurrentOptions, $variantIDs);
			
		}
		
	}//end updateOptions()
	
	/**
	 *
	 * Rename multiple fields of product options.
	 *
	 * @param array $currentOptions An associative array for current options
	 * the indices are the original field names.
	 * @param array $variantIDs A numerically indexed array for valid Variant IDs
	 *
	 * @return boolean True if successful. False otherwise.
	 **/
	public function renameOptionFields($currentOptions=array(), $variantIDs = array()) {
		
		
		if (!empty($variantIDs) && !empty($currentOptions)) {
			
			$currentOptionsData = array();
			$optionModel = $this->Variant->VariantOption;
			$optionModel->recursive = -1;
			$result = true;
			foreach($currentOptions as $originalField => $option) {
				$field = ($option['new_field'] == 'custom' && !empty($option['custom_new_field'])) ? $option['custom_new_field'] : $option['new_field'];
				$fieldsToUpdate = array('VariantOption.field'=>"'" . $field . "'");
				$conditions = array('VariantOption.field '=>$originalField,
						    'VariantOption.variant_id'   =>$variantIDs);
				
				$result = $result && $optionModel->updateAll($fieldsToUpdate, $conditions);
				
			}
			
			return $result;	
			
		}
		return false;
	}
	
	/**
	 *
	 * Delete multiple product options.
	 *
	 * @param array $options An associative array for options to be deleted
	 * the indices are the original field names. 
	 * @param array $variantIDs A numerically indexed array for valid Variant IDs
	 *
	 * @return boolean True if successful. False otherwise.
	 **/
	public function deleteAllOptions($options=array(), $variantIDs = array()) {
		
		
		if (!empty($variantIDs) && !empty($options)) {
			$optionModel = $this->Variant->VariantOption;
			$optionModel->recursive = -1;
			
			$fields = array_keys($options);
			
			$conditions = array('VariantOption.field'=>$fields,
					    'VariantOption.variant_id'   =>$variantIDs);
				
			return $optionModel->deleteAll($conditions);
			
		}
		return false;
	}
	
	/**
	 *
	 * Add new product options. Basically find all Variants of this Product.
	 * Add in the option field, option value for all these Variants.
	 * 
	 * If add just 1 option, then wrap that option into an array
	 * 
	 * @param integer $productID the Product id which we want to add new options to
	 * @param array $newOptions A numerically indexed array for new options
	 * @param array $variantIDs A numerically indexed array for valid Variant IDs
	 *
	 * @return boolean Return true if successful save. False otherwise.
	 **/
	public function addNewProductOptions($productID, $newOptions=array(), $variantIDs = array()) {
		
		if ($productID > 0 && !empty($newOptions)) {
			
			if (empty($variantIDs)) {
				$variantIDs = $this->Variant->find('list', array('conditions'=>array('Variant.product_id' => $productID),
								         'fields'    =>array('Variant.id')));
			
			}
			
			// form the new options
			$newOptionData = array();
			$nextOrder = $this->getNextOptionOrder($productID);
			
			foreach($newOptions as $key=>$option) {
				$field = ($option['field'] == 'custom' && !empty($option['custom_field'])) ? $option['custom_field'] : $option['field'];
				$value = $option['value'];
				foreach($variantIDs as $variantID) {
					$newOptionData[] = array('variant_id'	=>$variantID,
								 'value'	=>$value,
								 'field'	=>$field,
								 'order'	=>$nextOrder);
					
				}
				// increment the nextOrder
				$nextOrder++;
			}
			// saveAll the VariantOption
			return $this->Variant->VariantOption->saveAll($newOptionData);
			
		}
		return false;
		
	}//end addNewProductOptions
	
	/**
	 * get the next Option order by Product id
	 * if currently the maximum order is 1, then the result should be 2.
	 *
	 * @param integer $productID Product id
	 * @return mixed False if not valid, otherwise returns the next order no.
	 **/
	public function getNextOptionOrder($productID = false) {
		$optionModel = $this->Variant->VariantOption;
		$optionModel->recursive = -1;
		
		$optionModel->Behaviors->load('Linkable.Linkable');
		
		$nextOrder = $optionModel->find('first', array(	'conditions'=>array('Product.id'=>$productID),
									'link'=>array('Variant'=>array(
											'Product'=>array('fields'=>array('Product.id')),
											'fields'=>array('Variant.id', 'Variant.product_id')),
											
									      ),
								'fields'=>array('MAX(VariantOption.order) as next_order')
							)
						);
		
		/**
		 *
		 * $nextOrder gives back an
		 * array (
			[0] => Array
			(
			   [next_order] => 1
			),
			[Variant] => Array
			(
			    [id] => 2
			    [product_id] => 7
			),
			[Product] => Array
			(
			    [id] => 7
			)
		 )
		 * 
		**/
		
		
		// cannot use !empty because possible to get 0
		// 0 is defined as empty
		if (isset($nextOrder['0']['next_order']) && is_numeric($nextOrder['0']['next_order'])) {
			return intval($nextOrder['0']['next_order']) + 1;
			
		}
		
		return 0;
	}//end getNextOptionOrder()
	
	public function afterSave($created) {
		
		/**
		 * for products admin_edit ONLY
		 * we need to affect the Variant Options where applicable
		 * provided that Product.options is not empty AND Product.edit_options is 1 AND
		 * this is not a brand new Product
		 * using updateOptions function
		 * 
		 **/
		$oldProductOptionsSet 	= !empty($this->data['Product']['options']);
		$editOptionsSet		= !empty($this->data['Product']['edit_options']) && ($this->data['Product']['edit_options'] == 1);
		$updateOptions 		=  ($oldProductOptionsSet AND !$created AND $editOptionsSet);
		
		if ($updateOptions) {
			$this->updateOptions($this->data);
		}
		
		/**
		 * for products admin_add and admin_edit
		 * we need to save the images from $_FILES
		 * for $created, we need to also mark the first file as cover image
		 **/
		$this->ProductImage->saveFILESAsProductImages($this->id, $created);
		
		/**
		 * check if any images were marked as cover
		 * if no cover image, we will randomly assign one
		**/
		if (!$created) {
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
			
			$imagesMarkedAsCover = $this->find('all', $conditions);
			$noCoverImageForProduct = empty($imagesMarkedAsCover);
			if ($noCoverImageForProduct) {
				$this->ProductImage->recursive = -1;
				$topImage = $this->ProductImage->find('all', array('conditions'=>array('product_id'=>$this->id),
								       'fields'=>array('ProductImage.id'),
								       'limit'=>1));
				
				$this->ProductImage->chooseAsCoverImage($topImage[0]['ProductImage']['id'], $this->id);
			}	
		}
		/** end of product images **/
		
		
		/** update cart_items weight and price 
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
		**/
		
		/** end of cart_items weight and price **/
		
		/** Associate this product with custom collections **/
		$customCollectionsJoined = (!empty($this->data['Product']['selected_collections'])) ? $this->data['Product']['selected_collections'] : array();

		$this->saveIntoCollections($this->id, $customCollectionsJoined);	
		

		/** update smart collections **/
		$product 	= $this->data['Product'];
		$product['id'] 	= $this->id;
		$this->smartUpdateProductsInGroup($product);

		$this->updateProductLinks();

	}
	
	private function updateProductLinks() {
		$this->Link->recursive = -1;
		
		// get the new handle 
		$handle = isset($this->data['Product']['handle']) ? $this->data['Product']['handle'] : '';
		$model 	= '/products/';
		
		// form the new route
		$route  = $model . $handle;
		// form the new fields and values
		$fields = array('Link.route' =>$route,
				'Link.model' =>$model,
				'Link.action'=>$handle);
		
		// prepare the fields by wrapping the values in quotes
		App::uses('StringLib', 'UtilityLib.Lib');
		$fields = StringLib::iterateArrayWrapStringValuesInQuotes($fields);
		
		// meant only for all the ProductLinks belonging to this Product
		$conditions = array('Link.parent_id'=>$this->id,
				    'Link.parent_model'=>'Product');
		
		return $this->Link->updateAll($fields, $conditions);
		
	}
	
	/**
	 * for use in templates for shopfront pages
	 * */
	public function getTemplateVariable($products=array(), $multiple = true) {
		App::uses('ArrayToIterator', 'Lib');
		$results = array();
		
		if (!$multiple) $products = array($products);
		
		foreach($products as $key=>$product) {
			
			/**
			 * prepare ProductImage first;
			 **/
			if (!empty($product['ProductImage'])) {
				$images = Set::extract('ProductImage.{n}.filename', $product);	
			} else {
				$images = array();
			}
			
			/**
			 * Vendor
			 **/
			$vendor = (!empty($product['Vendor'])) ? $product['Vendor'] : array();
			
			/**
			 * Variants
			 **/
			if (!empty($product['Variant'])) {
				$variants =  VariantModel::getTemplateVariable($product['Variant']);
			} else {
				$variants = (TWIG_ITERATOR) ? ArrayToIterator::array2Iterator(array()) : array();
			}
			
			/* Collections */
			if (!empty($product['ProductsInGroup']) ) {
				$collections = ProductGroup::getTemplateVariable($product['ProductsInGroup']);
			} else {				
				$collections = (TWIG_ITERATOR) ? ArrayToIterator::array2Iterator(array()) : array();
			}
			
			/* store the original variants. needed for deriving Product Options */
			$originalVariants = (!empty($product['Variant']))  ? $product['Variant'] : array();
			
			/* now we isolate Product data */
			$product = isset($product['Product']) ? $product['Product'] : $product;
			
			/* preparing Product options first */
			if (empty($product['options'])) {
				if (!empty($originalVariants)) {
					$product['options'] = Product::extractProductOptionsFrom(array('Variant'=>$originalVariants));	
				} else {
					$product['options'] = array();
				}
			}
			
			$options = array_keys($product['options']);
			if (TWIG_ITERATOR) {
				$options = ArrayToIterator::array2Iterator($options);	
			}
			
			
			/* now we build  the template variable */
			$result = array('id' => $product['id'],
					'title' => $product['title'],
					'code' => $product['code'],
					'description' => $product['description'],
					'price' => $product['price'],
					'handle' => $product['handle'],
					'underscore_handle' => str_replace('-', '_', $product['handle']),
					'url' => $product['url'],
					'weight' => $product['weight'],
					// hardcode this available field to test checkout
					'available' => 1,
					);
			
			/*
			  assign the peripheral data back into Product Template Variable
			  eg, ProductImage, Vendor, Product options, Variant, Collection
			*/
			$result['images'] 	= (TWIG_ITERATOR) ? ArrayToIterator::array2Iterator($images) : $images;
			$result['cover_image'] 	= isset($images[0]) ? $images[0] : '';
			
			$result['vendor'] 	= !empty($vendor['title']) ? $vendor['title'] : '';			
			$result['variants']	= $variants;
			$result['collections'] 	= $collections;
			
			$result['options']	= $options;
			
			$results[$result['underscore_handle']] = $result;
		}
		
		if ($multiple && TWIG_ITERATOR) {
			$results = ArrayToIterator::array2Iterator($results);
		}
		
		if (!$multiple && !empty($results)) {
			return current($results);
		} else if (!$multiple && empty($results)) {
			return array();
		}
		
		return $results;
	}
	
	/**
	 *
	 * Product of $id joins a list of ProductGroups/Collections whose ids are listed in $newCollections.
	 * 
	 * Any Collection or ProductGroup which this Product is linked with PRIOR to this function
	 * will be delinked AFTER this function is called.
	 * 
	 * if Product of $id ProductGroups not listed in $newCollections are automatically 
	 *
	 * @param int $id id of Product 
	 * @param array $newCollections List of ProductGroup ids which the said Product wants to join ONLY.
	 *
	 * @return Returns true if successful. False otherwise.
	 **/
	public function saveIntoCollections ($id, $newCollections = array()) {
		
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
		if (!empty($associations)) {
			$existingGroups = Set::extract('{n}.ProductsInGroup.product_group_id', $associations);
		} else {
			$existingGroups = array();
		}
		
		

		/** existingGroups from here and customCollections from the view look like this **/
		//Array
		//(
		//    [0] => 2
		//    [1] => 3
		//)
		
		
		// do some array_diff to get new records
		$newRecords = array_diff($newCollections, $existingGroups);
		
		// do some array_diff to get deleted records
		$deletedRecords = array_diff($existingGroups, $newCollections);
		
		// combined union of the unique values
		$unionRecords = array_unique(array_merge($newCollections, $existingGroups));
		
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
		
		$result = true;
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
			
			if ($result != false) {
				$result = true;
			}

		}
		
		// now we call the Many2manyCounterCache->_updateCounterCache
		$this->updateCounterCacheForM2MMain($id, $unionRecords);
		
		return $result;
	}
	
	/**
	*
	* Update Counter Cache of the selected groups or selected product
	*
	* @param int $id Product Id
	* @param array $groupIds Array containing group ids. If empty, we will dig up all the associated groups
	* @param boolean $updateAllCount Default value is true
	* @return boolean Return true if successful.
	*
	**/
	public function updateCounterCacheForM2MMain($id, $groupIds=array(), $updateAllCount=true) {
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
		
		return true;
	}

	/**
	*
	* Breaks down a conditionalarray into the array format version to be used in for cake find
	*
	* @param array $conditionalArray Array containing conditions. Associative array containing field, relation, condition.
	* Relation must be one of the following: equals, starts_with, ends_with, contains, greater_than, less_than.
	* field, and condition represent the field and the value to be formatted.
	* @return string Returns array format of the conditions required for cake find
	**/
	public function formatCakeConditions($conditionalArray) {
		$conditions = array();
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
		
	}//end formatCakeConditions()
	
	
	/**
	 * @param array $product this is the associative array of the product without Product index present
	 * @param array $conditionalArrays this must be a numerically indexed array of the conditions
	 *  that is the list of conditions without SmartCollectionCondition index present
	 * */
	private function evaluateAgainstSmartConditions($product, $conditionalArrays) {
		App::uses('StringLib', 'UtilityLib.Lib');
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
				  $ok = StringLib::startsWith($fieldInProduct, $value,  false);
				  break;
				case "ends_with":
				  //Field in Product should end with value
				  $ok = StringLib::endsWith($fieldInProduct, $value, false);
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
	 * 
	 * This function is used to update the ProductsInGroup for SmartCollections given a particular Product $product
	 *
	 * @param array $product this is the associative array of the product without Product index present
	 * @return boolean Return true if successful
	 * */
	public function smartUpdateProductsInGroup($product) {
		
		$result = true;
		
		$collectionModel = $this->ProductsInGroup->ProductGroup;
		$collectionModel->recursive = -1;
		$collectionModel->Behaviors->load('Containable');
			
		$smartCollections = $collectionModel->find('all', array(
			'conditions'=>array(
				'ProductGroup.shop_id'=>Shop::get('Shop.id'),
				'ProductGroup.type'=>SMART_COLLECTION
			),
			'contain'   =>array('SmartCollectionCondition')
		));
		
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
	
	/**
     * This function does a DEEP $this->find('first') 
     * supplying a Product that is visible with all the Product fields
     * with a full list of Variant, ProductImage, ProductsInGroup, Vendor, ProductType.
     * 
     * Alias for getDetails($id, true) 
     *
     * @param integer $id Product Id
     * 
     * @return array of product info as explained above
     * */
	public function getDetailsEvenHidden($id) {
		return $this->getDetails($id, true);
	}
        
    /**
     * This function does a DEEP $this->find('first') 
     * supplying a Product that is visible with all the Product fields
     * with a full list of Variant, ProductImage, ProductsInGroup, Vendor, ProductType.
     * 
     * Each Variant contains a list of VariantOption.
     * Each ProductsInGroup contains the ProductGroup this Product belongs to.
     * ProductImage only contains the filename and the cover image is the first in the list.
     *
     * Product will also have an options which will give a list of options that is extracted using
     * $this->extractProductOptionsFrom
     * 
     * @param integer $id Product Id
     * @param boolean $doWeWantHiddenProduct True if we want to include hidden product
     * 
     * @return array of product info as explained above
     * */
	public function getDetails($id, $includeHiddenProduct = false) {
		
		$shopId = Shop::get('Shop.id');
		$excludeHiddenProduct = !$includeHiddenProduct;
		
		$conditions = array(
			'Product.id'=>$id, 
			'Product.shop_id'=>$shopId
		);
		
		if ($excludeHiddenProduct) {
			$conditions['Product.visible'] = true;
		}
		
		$productFound = $this->find('first', array(
			'conditions' => $conditions,
			'contain' => array(
				'Variant' => array(
					'conditions' => array(
						'Variant.product_id' => $id
					),
					'order'=>'Variant.order ASC',
					'VariantOption' => array(
						'fields' => array('id', 'value', 'field', 'variant_id'),
						'order'  => 'VariantOption.order ASC',
					)
				),
				'ProductImage'=>array(
					'fields' => array('filename'),
					'order'=>array('ProductImage.cover DESC'),
				),
				'ProductsInGroup'=>array(
					'fields' => array('id', 'product_id'),
					'ProductGroup'=>array(
						'fields' => array(
							'id', 'title', 'handle',
							'description', 'visible_product_count',
							'url', 'vendor_count', 'type'
						),
					)
				)
			),
			'link' => array(
				'Vendor' => array('fields' => 'title'),
				'ProductType' => array('fields' => 'title'),
			),
		));
		
		// extract the unique VariantOptions for the Product
		$productOptions = $this->extractProductOptionsFrom($productFound);
		
		// format the numerically indexed VariantOptions
		// into an associative array using the "field" as index
		$productFound = $this->formatVariantOptionKey($productFound);
		
		// insert the options into the Product
		$validProduct 		  = !empty($productFound) && !empty($productFound['Product']['id']);
		$validProductOptions 	  = !empty($productOptions);
		$insertOptionsIntoProduct = $validProduct AND $validProductOptions;
		
		if ($insertOptionsIntoProduct) {
			$productFound['Product']['options'] = $productOptions;
		}
		
		return $productFound;
	}//end getDetails()
	
	
	/**
	 * Extracts the list of VariantOption associated with a single Product
	 *
	 * @param array $productDetails The full details of this Product in array format.
	 * $this->getDetails gives you such full details.
	 *
	 * @return array An array of option data. Maximum length is 3.
	 * the array returned will be in this format
	 *
	 * array[
	 * 	// first VariantOption
		// the field name Size is used as index
	 *      ['Size'] => array[
	 *      	option_ids => array(16, 17, 19), // the VariantOption ids that have the same field and belong to the same Product via Variant
			values_in_string => 'Medium, Large', // the values delimited by commas
			values => array('Medium', 'Large'), // the values in array format
			
	 *      	]
	 *      // second VariantOption
		// the field name Title is used as index
		['Title'] => array[
	 *      	option_ids => array(20, 21, 23), // the VariantOption ids that have the same field and belong to the same Product via Variant
			values_in_string => 'Pink, Purple', // the values delimited by commas
			values => array('Pink', 'Purple'), // the values in array format
			
	 *      	]
		....
	 *      
	 *	]
	 * 
	 **/
	public function extractProductOptionsFrom($productDetails = array()) {
		
		$variants = Set::extract('Variant.{n}.VariantOption', $productDetails);
		
                $voption = array();
                
                if (!empty($variants)) {                        
                        foreach ($variants as $variantOptions) {
                                if (!empty($variantOptions)) {
                                        foreach ($variantOptions as $variantOption) {
                                                $fieldName 	= $variantOption['field'];
						$optionValue 	= $variantOption['value'];
						$optionId 	= $variantOption['id'];
						// if no such field, we create it and store the appropriate option id and value
						if (!isset($voption[$fieldName])) {
							$voption[$fieldName] = array('values'	 =>array($optionValue),
										     'option_ids'=>array($optionId));
						} else {
							// check if we have stored this value and store it if not existent
							if (!in_array($optionValue, $voption[$fieldName]['values'])) {
								$voption[$fieldName]['values'][] = $optionValue;
							}
							// check if we have stored this option id and store it if not existent
							if (!in_array($optionId, $voption[$fieldName]['option_ids'])) {
								$voption[$fieldName]['option_ids'][] = $optionId;
							}
						}
                                        }
                                }
                        }
			
			$isOptionsValid = !empty($voption);
			
			
			if ($isOptionsValid) {
				// implode the array of values into string delimited by comma
				// for every single possible option field
				foreach($voption as $fieldName => $option) {
					if (!empty($option['values'])) {
						// convert all the values into string
						$voption[$fieldName]['values_in_string'] = implode(', ', $option['values']);		
					}
				}
			}
                }
                return $voption;
	}//end extractProductOptionsFrom
	
	/**
	 * Each Variant in Product has a list of VariantOptions. Basically it is a
	 * numerically-indexed array. So we are going to change this into an associative array.
	 * This associative array will use the "field" as the index
	 *
	 * @param array $productDetails Full details of Product generated by getDetails()
	 * @return array $productDetails which will have the index for VariantOptions changed for all its Variants
	 * 
	 * */
	protected function formatVariantOptionKey($productDetails = array()) {
		
		if (!empty($productDetails['Variant']) && is_array($productDetails['Variant'])) {
			foreach ($productDetails['Variant'] as $key =>$variant) {
				if (!empty($variant['VariantOption']) && is_array($variant['VariantOption'])) {
					$productDetails['Variant'][$key]['VariantOption'] = Set::combine($variant['VariantOption'], '{n}.field', '{n}');
				} 
			}
		}
		
		return $productDetails;
		
	}//end formatVariantOptionKey
	
	
	/**
	*
	* Handle Menu action for multiple select
	*
	* @param array $data Data array containing Product
	* @return array Result array containing the indices success and message
	**/
	public function handleMenuAction($data) {
		$resultArray = array(
			'message'=>'No valid actions selected',
			'success'=>false
		);
		
		switch($data['Product']['menu_action']) {
			case 'Delete' :
				$resultArray['success'] = $this->deleteSelected($data['Product']['selected']);
				$resultArray['message'] = ($resultArray['success']) ? 'Selected products are successfully deleted' : 'Error';
				break;
				
			case 'Publish' :
				$resultArray['success'] = $this->publishSelected($data['Product']['selected']);
				$resultArray['message'] = ($resultArray['success']) ? 'Selected products are successfully published' : 'Error';
				break;
				
			case 'Hide' :
				$resultArray['success'] = $this->hideSelected($data['Product']['selected']);
				$resultArray['message'] = ($resultArray['success']) ? 'Selected products are successfully hidden' : 'Error';
				break;
			
		}
		
		return $resultArray;
	}
	
	/**
	*
	* Deletes selected model records. Used by HandleMenuAction
	*
	* @param array $selected Data array containing Product
	* @return boolean Returns true if successful
	**/
	protected function deleteSelected($selected = array()) {
		$selected = array_unique($selected);
		return $this->deleteAll(array(
			'Product.id'=>$selected,
			'Product.shop_id'=>Shop::get('Shop.id')
		));
	}
	
	/**
	*
	* Publishes selected model records. Used by HandleMenuAction
	*
	* @param array $selected Data array containing Product
	* @return boolean Returns true if successful
	**/
	protected function publishSelected($selected = array()) {
		$this->recursive = -1;
		$selected = array_unique($selected);
		return $this->updateAll(array(
			'Product.visible'=>true),
			array(
				'Product.id' => $selected,
				'Product.shop_id'=>Shop::get('Shop.id')
			)
		);
	}
	
	/**
	*
	* Hides selected model records. Used by HandleMenuAction
	*
	* @param array $selected Data array containing Product
	* @return boolean Returns true if successful
	**/
	protected function hideSelected($selected = array()) {
		$this->recursive = -1;
		$selected = array_unique($selected);
		return $this->updateAll(array(
			'Product.visible'=>0),
			array(
				'Product.id' => $selected,
				'Product.shop_id'=>Shop::get('Shop.id')
			)
		);
	}
	
	
	/**
	* get all visible Products by Shop
	*
	* @param $shop_id int 
	* @param $limit int Default is 30
	* @return array 
	*
	**/
	public function getAllVisibleByShopId($shop_id, $limit = 30) {
		if (!($shop_id > 0)) {
			return false;
		}
		

		// set to limit = 30
		$getAllVisibleProducts = array(
			'limit' => $limit
		);
			
		
		$productPaginate 		= $this->ProductsInGroup->ProductGroup->prepCommonProductPaginate();
		$getAllVisibleProducts 	= array_merge($getAllVisibleProducts, $productPaginate);
		
		// set the shop_id
		$getAllVisibleProducts['conditions']['AND']['Product.shop_id'] = $shop_id;
		
		$rawProducts 	= $this->find('all', $getAllVisibleProducts);
		
		return $rawProducts;
	}
	
	/**
	* 
	* Retrieve Product data and CoverImage data.
	* Format of array is
	* array(
	*		'0' => array(
	*			'id' => '1'
	*			'title' => 'Dummy Product',
	*			'CoverImage' => array('dir'=>.., 'filename'=>'...')
	*		),
	*		'1' => array(
	*			'id' => '2'
	*			'title' => 'Some Product',
	*			'CoverImage' => array('dir'=>.., 'filename'=>'...')
	*		),
	*	
	* )
	*
	* @param int $group_id ProductGroup id
	* @return array Returns minimal Product data and CoverImage data
	**/
	public function getAllWithImagesByShopId($shop_id) {
		
		$conditions = array(
			'Product.shop_id' => $shop_id
		);
		
		return $this->getAllWithImagesByConditions($conditions);
		
	}
	
	/**
	* 
	* Retrieve Product data and CoverImage data.
	* Format of array is
	* array(
	*		'0' => array(
	*			'id' => '1'
	*			'title' => 'Dummy Product',
	*			'CoverImage' => array('dir'=>.., 'filename'=>'...')
	*		),
	*		'1' => array(
	*			'id' => '2'
	*			'title' => 'Some Product',
	*			'CoverImage' => array('dir'=>.., 'filename'=>'...')
	*		),
	*	
	* )
	*
	* @param int $group_id ProductGroup id
	* @return array Returns minimal Product data and CoverImage data
	**/
	public function getAllWithImagesByTitleShopId($title, $shop_id) {
		
		$title = addslashes(trim($title));
		
		$conditions = array(
			'Product.title LIKE "%'.$title.'%"',
			'Product.shop_id' => $shop_id,
		);
		
		return $this->getAllWithImagesByConditions($conditions);
		
	}
	
	/**
	* 
	* Retrieve Product data and CoverImage data.
	* Format of array is
	* array(
	*		'0' => array(
	*			'id' => '1'
	*			'title' => 'Dummy Product',
	*			'CoverImage' => array('dir'=>.., 'filename'=>'...')
	*		),
	*		'1' => array(
	*			'id' => '2'
	*			'title' => 'Some Product',
	*			'CoverImage' => array('dir'=>.., 'filename'=>'...')
	*		),
	*	
	* )
	*
	* @param array $conditions
	* @return array Returns minimal Product data and CoverImage data
	**/
	public function getAllWithImagesByConditions($conditions) {
		
		$items = $this->find('all', array(
			'conditions' => $conditions,
			'contain' => array(
				'ProductImage' => array(
					'conditions' => array(
						'ProductImage.cover' => 1
					),

				),
				'ProductsInGroup'
			),

			
		));

		$productsWithCover = array();
		
		foreach($items as $item) {
			// extract the cover image data
			$cover = $item['ProductImage'][0];
			// remove cover image from the $item
			unset($item['ProductImage']);
			// extract the pure Product data
			$product = $item['Product'];
			// set the new Product to include the CoverImage data
			$product['CoverImage'] = $cover;
			// put the new Product data into the results array
			$productsWithCover[] = $product;
		}

		return $productsWithCover;
	}
	
}//end class