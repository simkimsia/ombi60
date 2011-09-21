<?php
class ProductsInGroup extends AppModel {
	var $name = 'ProductsInGroup';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	

	var $belongsTo = array(
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
	function checkProductInCollection($productHandle, $collectionHandle, $shopId = null) {
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


}//end class