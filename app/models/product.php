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
			       'Sluggable'=> array(
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
	
	
	/**
	 * For unit conversion
	 * */
	function afterFind($results, $primary) {
		
                $unit = Shop::get('ShopSetting.unit_system');
		
		foreach ($results as $key => $val) {
			if (isset($val['Product'])) {
				$results[$key] = $this->convertForDisplay($val, $unit);
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

		return $this->saveAll($data, array('validate'=>'first'));

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

}
?>