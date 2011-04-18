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
			'counterCache' => true,
			'counterScope' => array('Product.visible' => 1) 
		),
		'Vendor' => array(
			'className' => 'Vendor',
			'foreignKey' => 'vendor_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => false,
			'counterScope' =>  '',
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

		$result = $this->saveAll($data, array('validate'=>'first',
						      'atomic' => false));
		
		
		
		return $result;

	}
	
	function duplicate($id = NULL, $shop_id = 0) {
		// this product model is copied but NOT recursively.
		$result = $this->copy($id);

		// now we need to duplicate all the related product images
		if ($result) {
			// first we need to retrieve all the ProductImages belonging to the original Product
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
			$groups = $this->ProductsInGroup->find('all', array(
							'conditions' => array('product_id' => $id),
							'fields' => array('ProductsInGroup.product_group_id')
							));
			
			$duplicateGroups = Set::extract('{n}.ProductsInGroup.product_group_id', $groups);
			$this->saveCollections($this->id, $duplicateGroups);
			
		}

		// this is to copy the product to another shop
		// most likely to be solely used for the dummy first product of a newly created shop
		if ($shop_id > 0) {
			$this->set('shop_id', $shop_id);
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
		}
		
		
		/** end of cart_items weight and price **/
		
		/** Associate this product with custom collections **/
		//if (!$created) {
			$customCollectionsJoined = is_array($this->data['Product']['selected_collections']) ? $this->data['Product']['selected_collections'] : array();
			$this->saveCollections($this->id, $customCollectionsJoined);	
		//}
		
		
	}
	
	/**
	 * for use in templates for shopfront pages
	 * */
	function getTemplateVariable($products=array()) {
		
		$results = array();
		
		foreach($products as $key=>$product) {
			$results[] = array('id' => $product['Product']['id'],
					   'title' => $product['Product']['title'],
					   'code' => $product['Product']['code'],
					   'description' => $product['Product']['description'],
					   'price' => $product['Product']['price'],
					   'handle' => $product['Product']['handle'],
					   'url' => '/products/' . $product['Product']['handle'],
					   );
			
			//if (isset($product['Product']))
		}
		
		
		
		return $results;
	}
	
	function saveCollections ($id, $customCollections = array()) {
		if (empty($customCollections)) {
			return true;
		}
		
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
		
		// check if we need to insert new records
		// AND/OR delete old records
		$newRecordsOn = !empty($newRecords);
		$deletedRecordsOn = !empty($deletedRecords);
		$doTransaction = $newRecordsOn OR $deletedRecordsOn;
		
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
			
			return $result;
		}
		
		return true;
	}

}
?>