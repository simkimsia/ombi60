<?php
class ProductsInGroup extends AppModel {
	public $name = 'ProductsInGroup';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	

	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProductGroup' => array(
			'className' => 'ProductGroup',
			'foreignKey' => 'product_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

  
	/**
	 * Check if this Product belongs to this Regular Collection
	 * Both Product and Collection are Visible and in the same Shop
	 * @param string $productHandle Handle of Visible Product
	 * @param string $collectionHandle Handle of Visible Collection
	 * @param integer $shopId Optional. Id of Shop. Default is null. We will search by current shop
	 * @return boolean Returns true if Visible Product belongs to Visible Collection in same Shop
	 */
	public function checkProductInCollection($productHandle, $collectionHandle, $shopId = null) {
		if ($shopId == null) {
		   	$shopId = Shop::get('Shop.id');		
		}


		$this->unbindModel(array(
			'belongsTo' => array(
				'Product', 'ProductGroup'
				)
			)
		);

		$this->bindModel(array(
			'hasOne' => array(
				'Product' => array(
					'className' => 'Product',
					'foreignKey' => false,
					'conditions' => array(
						'ProductsInGroup.product_id = Product.id'
						)
					),
				'ProductGroup' => array(
					'className' => 'ProductGroup',
					'foreignKey' => false,
					'conditions' => array(
						'ProductGroup.id = ProductsInGroup.product_group_id'
						)
					)
				)
			)
		);

		$conditions = array(

			'conditions' => array(
				'Product.shop_id'	=> $shopId,
				'Product.visible'	=> true,
				'Product.handle'	=> $productHandle,
				'ProductGroup.shop_id'	=> $shopId,
				'ProductGroup.visible'	=> true,
				'ProductGroup.handle'	=> $collectionHandle,
	            ),
			'fields'     => array(
				'ProductsInGroup.id',

				'Product.id',
				'ProductGroup.id',

				),
			);

		$record = $this->find('first', $conditions);
		$exists = !empty($record);

		// if there is no custom collection called all
		// and the url is collections/all/products/product-handle
		// we need to search within products
		$searchWithinCollectionAll = (!$exists && $collectionHandle == 'all');

		if ($searchWithinCollectionAll) {
			$conditions = array(
				'conditions' => array(
					'Product.shop_id'	=> $shopId,
					'Product.visible'	=> true,
					'Product.handle'	=> $productHandle,
	                ),
				'fields'     => array(
					'Product.id',
					),
			);

			$record = $this->Product->find('first', $conditions);

			return !empty($record);
		}

		return $exists;

	}//end checkProductInCollection()
	
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
	public function getProductsWithImagesByGroupId($group_id) {
		
		$items = $this->find('all', array(
			'conditions' => array(
				'ProductsInGroup.product_group_id' => $group_id,

			),
			'contain' => array(
				'Product' => array(
					'ProductImage' => array(
						'conditions' => array(
							'ProductImage.cover' => 1
						),

					),
					'fields' => array(
						'Product.id', 
						'Product.title',
						'Product.code',
					)
				)
			
			),
			
		));

		$productsWithCover = array();
		
		foreach($items as $item) {
			// extract the cover image data
			$cover = $item['Product']['ProductImage'][0];
			// remove cover image from the $item
			unset($item['Product']['ProductImage']);
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